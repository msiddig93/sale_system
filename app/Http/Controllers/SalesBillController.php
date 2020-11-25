<?php

namespace App\Http\Controllers;

use App\sales_bill;
use App\SaleDetail;
use App\Product;
use Illuminate\Http\Request;

class SalesBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sales_bills = sales_bill::orderBy('id','desc')->get();
        return view('sales_bill.index',compact('sales_bills'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        
        $sales_bills = sales_bill::orderBy('id','desc')->get();
        return view('sales_bill.report',compact('sales_bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales_bill.create');
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
            if(SaleDetail::where("sales_bill_id",\App\sales_bill::max('id')+1)->count() == 0 )
                return redirect()->back()->withInput()->with(['error' => "لم يتم إضافة أي منتجات لهذه الفاتورة ."]);
            $sale_details = SaleDetail::where("sales_bill_id",\App\sales_bill::max('id')+1)->get();

            $bill = sales_bill::create([
                'total_amount' => $request->total_amount,
                'user_id' => auth()->user()->id,
            ]);
                
            foreach($sale_details as $sale_detail ){
                $sale_detail->update([
                    "sales_bill_id" => $bill->id
                ]);

                $product = Product::find($sale_detail->product_id);
                $product->update([
                    "qte" => $product->qte - $sale_detail->qte
                ]);
            }


            return redirect()->route('sales_bill.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return $ex;
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\sales_bill  $sales_bill
     * @return \Illuminate\Http\Response
     */
    public function show(sales_bill $sales_bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     
     * @param  \App\sales_bill  $sales_bill
     * @return \Illuminate\Http\Response
     */
    public function edit(sales_bill $sales_bill)
    {
        $sales_bill = SalesBill::find($id);
        return view('sales_bill.edit',compact('sales_bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sales_bill  $sales_bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales_bill $sales_bill)
    {
        try{ 
            $sales_bill = SalesBill::find($request->id);

            if($request->password){
                $sales_bill->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $sales_bill->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            
            return redirect()->route('sales_bill.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sales_bill  $sales_bill
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $sales_bill = sales_bill::find($id);

        $sales_bill->delete();
        return redirect()->route('sales_bill.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);           
    }
}
