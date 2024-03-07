<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $galerys = Galery::join('users','users.id','=','galeries.id_user')
            ->where('galeries.status', 'pending')
            ->select('galeries.*','users.username')
            ->get();

            return view('Page.admin.persetujuan',compact('galerys'));
        }else{
            return redirect('/');
        }
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
        $user = Auth::user();
        $status = $request->status;
        $ids = $request->id;
        if ($user->level == 'admin') {
            if ($ids) {
                if ($status == 'acc') {
                    foreach( $ids as $id){
                        Galery::where('id', $id)->update([
                            'status' => 'accept'
                        ]);
                    }
                    return back()->with('success','Foto Berhasil Untuk Di Acc');
                }
                if ($status == 'declined') {
                    foreach( $ids as $id){
                        Galery::where('id', $id)->update([
                            'status' => 'declined'
                        ]);
                    }
                    return back()->with('alert','Foto Berhasil Di Declined,Jika Ingin Mengembalikan Lihat Di Hostory Declined');
                } else {
                    return back()->with('info','Sliahkan Pilih Persetujuan');
                }
            }
            else {
                return back()->with('info','Sliahkan Pilih Persetujuan');
            }
            
        }else{
            return redirect('/');
        }
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
    public function historydeclined()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $galerys = Galery::join('users','users.id','=','galeries.id_user')
            ->where('galeries.status', 'declined')
            ->select('galeries.*','users.username')
            ->get();

            return view('Page.admin.historydeclined',compact('galerys'));
        }else{
            return redirect('/');
        }
    }
}
