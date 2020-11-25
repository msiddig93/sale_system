<?php

namespace App\Http\Controllers;

use App\SaleDetail;
use App\sales_bill;
use App\Product;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('sales_bill.add_product',compact('products'));
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
            if(SaleDetail::where(["sales_bill_id" => sales_bill::max('id')+1,"product_id" => $request->product_id])->count() > 0 ){
                return redirect()->back()->withInput()->with(['error' => "لقد تمت إضافة هذا المنتج مسبقاً ."]);            
            }

            // check if the qte is it available .
            if(Product::find($request->product_id)->qte < $request->qte ){
                return redirect()->back()->withInput()->with(['error' => "عفواً الكمية غير متوفرة حالياً  ."]);            
            }

            SaleDetail::create([
                'sales_bill_id' => sales_bill::max('id')+1,
                'product_id' => $request->product_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);

            return redirect()->route('sales_bill.create')->withInput()->with(['success' => "تمت إضافة المنتج بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SaleDetail = SaleDetail::find($id);
        $products = Product::orderBy('id','desc')->get();
        return view('sales_bill.edit_product',compact('SaleDetail','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{ 
            $product = SaleDetail::find($request->id);

            $product->update([
                'product_id' => $request->product_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);
            
            return redirect()->route('sales_bill.create')->withInput()->with(['success' => "تمت التحديث بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleDetail  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = SaleDetail::find($id);
        $product->delete();
        return redirect()->route('sales_bill.create')->withInput()->with(['success' => "تم الحذف بنجاح"]);
    }
}
