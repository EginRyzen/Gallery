<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
            $data = User::whereIn('level',['user'])->get();
            // $data = User::all();
            // dd($data);

            return view('Page.admin.galery',compact('data'));
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
        User::where('id', $id)->delete();

        return back()->with('alert', 'Berhasil Untuk Di Hapus!!');
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
    public function status($id)
    {
        // dd($id);
        $user = Auth::user();
        if($user->level == 'admin'){
            $status = User::where('id',$id)->first();
            if ($status->status == 1) {
                $data = [
                    'status' => '0'
                ];

                User::where('id',$id)->update($data);
                return back()->with('success', 'Behasil Untuk Update Status');
            }else{
                $data = [
                    'status' => 1
                ];
                User::where('id',$id)->update($data);
                return back()->with('success', 'Behasil Untuk Update Status!!');
            }
        }else{
            return redirect('/');
        }
    }
}
