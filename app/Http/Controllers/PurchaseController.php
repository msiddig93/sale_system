<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseDetail;
use App\Product;
use App\vendor;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_bills = Purchase::orderBy('id','desc')->get();
        return view('purchase_bill.index',compact('purchase_bills'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $purchase_bills = Purchase::orderBy('id','desc')->get();
        return view('purchase_bill.report',compact('purchase_bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = vendor::all();
        return view('purchase_bill.create',compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            // check if the email is used with another user
            if(PurchaseDetail::where("purchase_id",\App\Purchase::max('id')+1)->count() == 0 )
                return redirect()->back()->withInput()->with(['error' => "لم يتم إضافة أي منتجات لهذه الفاتورة ."]);
            $details = PurchaseDetail::where("purchase_id",Purchase::max('id')+1)->get();

            $bill = Purchase::create([
                'total_amount' => $request->total_amount,
                'vendor_id' => $request->vendor_id,
                'user_id' => auth()->user()->id,
            ]);
                
            foreach($details as $detail ){
                $detail->update([
                    "sales_bill_id" => $bill->id
                ]);

                $product = Product::find($detail->product_id);
                $product->update([
                    "qte" => $product->qte + $detail->qte
                ]);
            }


            return redirect()->route('purchase.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return $ex;
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Purchase::find($id);
        $product->delete();
        return redirect()->route('purchase.index')->withInput()->with(['success' => "تم الحذف بنجاح"]);
    }
}
