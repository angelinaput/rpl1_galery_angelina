<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function prosesLogin(Request $request) 
    {
        $data=$request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $data=$request->only('username','password');
        if (Auth::attempt($data)) {
            return redirect('/galery');
        }else{
            return redirect('/');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function saveRegister(Request $request)
    { 
       
        $data = $request->validate([
            'name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'email'=>'required'
        ]);

        

        $simpan=[
            'name'=>$data['name'],
            'username'=>$data['username'],
            'password'=>bcrypt($data['password']),
            'email'=>$data['email']
        ];

        User::create($simpan);
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout(){
        Auth::logout();
        session()->flush();

        return redirect('/');
    }
}
