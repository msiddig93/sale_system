<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            if(User::where('email',$request->email)->count() > 0 )
                return redirect()->back()->withInput()->with(['error' => "الرجاء تغيير البريد الالكتروني, مستخدم بالفعل مع مستخدم أخر ."]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('user.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return $ex;
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        
        try{ 
            $user = User::find($request->id);

            if($request->password){
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            
            return redirect()->route('user.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
        }catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => "حدثت مشكلة الرجاء المحاولة لاحقاً ."]);            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('user.index')->withInput()->with(['success' => "تمت الاضافة بنجاح"]);            
    }
}
