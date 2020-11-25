<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\vendor;

class VendoorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = vendor::orderBy('id','desc')->get();
        return view('vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        try{
            // check if the email is used with another user
            vendor::create([
                'name' => $request->name,
                'address' => $request->address,
                'country_name' => $request->country_name,
                'company' => $request->company,
            ]);

            return redirect()->route('vendor.index')->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendoor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendoor $vendor)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendoor  $ vendoor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = vendor::find($id);
        return view('vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendoor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        
        try{ 
            $vendor = vendor::find($request->id);

            $vendor->update([
                'name' => $request->name,
                'address' => $request->address,
                'country_name' => $request->country_name,
                'company' => $request->company,
            ]);
            
            return redirect()->route('vendor.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ Vendoor  $ vendoor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = vendor::find($id);

        $vendor->delete();
        return redirect()->route('vendor.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
    }}
