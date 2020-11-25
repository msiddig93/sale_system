<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $products = Product::all();
        return view('product.report',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('product.create',compact('categories'));
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
            Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);

            return redirect()->route('product.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
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
        $product = Product::find($id);
        return view('product.edit',compact('product'));
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
            $product = Product::find($request->id);

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'qte' => $request->qte,
                'price' => $request->price,
            ]);
            
            return redirect()->route('product.index')->withInput()->with(['success' => "تمت التحديث بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->withInput()->with(['success' => "تمت الحذف بنجاح"]);
    }
}
