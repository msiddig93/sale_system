<?php

namespace App\Http\Controllers;

use App\PurchaseDetail;
use App\Product;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('purchase_bill.add_product',compact('products'));
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
            // check if the product is already added to the bill 
            if(PurchaseDetail::where(["purchase_id" => Purchase::max('id')+1,"product_id" => $request->product_id])->count() > 0 ){
                return redirect()->back()->withInput()->with(['error' => "لقد تمت إضافة هذا المنتج مسبقاً ."]);            
            }

            PurchaseDetail::create([
                'purchase_id' => Purchase::max('id')+1,
                'product_id' => $request->product_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);

            return redirect()->route('purchase.create')->withInput()->with(['success' => "تمت إضافة المنتج بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $PurchaseDetail = PurchaseDetail::find($id);
        $products = Product::orderBy('id','desc')->get();
        return view('purchase_bill.edit_product',compact('PurchaseDetail','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        try{ 
            $product = PurchaseDetail::find($request->id);

            $product->update([
                'product_id' => $request->product_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);
            
            return redirect()->route('purchase.create')->withInput()->with(['success' => "تمت التحديث بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        $product = PurchaseDetail::find($id);
        $product->delete();
        return redirect()->route('purchase.create')->withInput()->with(['success' => "تم الحذف بنجاح"]);
    }
}
