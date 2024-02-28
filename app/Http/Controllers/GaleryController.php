<?php

namespace App\Http\Controllers;

use App\Models\galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdategaleryRequest;
use Facade\FlareClient\Http\Client;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galerys = Galery::where('iduser',Auth::user()->id)->get();
        return view('timeline',['galery'=>$galerys]);

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
     * @param  \App\Http\Requests\StoregaleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required'
        ]);
        
       $namafoto = Auth::user()->id.'-'.date('YmdHis').
            $request->foto->getClientOriginalName();

        $data=[
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
            'tanggal'=>now(),
            'foto'=>$namafoto,
            'iduser'=>Auth::user()->id
        ];

        $request->foto->move(public_path('images'), $namafoto);
        Galery::create($data);
        return redirect('/galery');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function show(galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategaleryRequest  $request
     * @param  \App\Models\galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, galery $galery)
    {
        if ($request->hasFile('foto')) {
            $namafoto = Auth::user()->id.'-'.date('YmdHis');
            $request->foto->getClientOriginalName();
            $request->foto->move(public_path('images'),$namafoto);
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->tanggal=now();
            $galery->foto= $namafoto;
            $galery->iduser=Auth::user()->id;
            $galery->save();
        }else{
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->tanggal=now();
            $galery->iduser=Auth::user()->id;
            $galery->save();
        }

        return redirect('galery'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Galery::where('id','=',$id)->delete();
        return redirect('galery');
    }
}
