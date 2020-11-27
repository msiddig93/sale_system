<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseDetail;
use App\Product;
use App\vendor;
use App\Bank;
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
    public function pay($id)
    {
        $purchase = Purchase::find($id);
        return view('purchase_bill.pay',compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function bank(Request $request, Purchase $purchase)
    {
        // return $request->all();
        if(empty($request->acc_number)){
            return redirect()->back()->withInput()->with(['error' => "فضلاً قم بإدخال رقم الحساب الذي سوف يتم تحويل قيمة الفاتورة له ."]);            
        }

        $bank = Bank::where("acc_number","2020202")->first();
        $vendor = Bank::where("acc_number",$request->acc_number)->first();

        if($bank){
            if($bank->balance < $request->total_amount){
                return redirect()->back()->withInput()->with(['error' => "عفواً ,رصيدك لا يكفى لإجرى هذه المعاملة ."]);            
            }

            $vendor->update([
                "balance" => $vendor->balance + $request->total_amount
            ]);

            $bank->update([
                "balance" => $bank->balance - $request->total_amount
            ]);

            Purchase::find($request->id)->update([
                "status" => 1,
            ]);

            return redirect()->route('purchase.index')->withInput()->with(['success' => "تم سداد عن طريق البنك بنجاح"]);

        }else{
            return redirect()->back()->withInput()->with(['error' => "لم يتم العثور على رقم حساب مطابق   ."]);
        }
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
