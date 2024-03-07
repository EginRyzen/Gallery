<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\Models\Galery;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $user = Auth::user();
        // dd($user);
        // $galery = Galery::where('id_user', $user->id)->where('status','accept')->latest()->get();
        $friendadd =  Friend::where('id_add', $user->id)
            ->orWhere('id_addto', $user->id)
            ->where('confirm', 'accept')
            // ->pluck('id_add')
            ->get()
            ->toArray();
        $idarray =  array_column($friendadd, 'id_add');

        // dd($idarray);
        $galery = Galery::whereIn('id_user', $idarray)
            ->orWhere('id_user', $user->id)
            ->where('galeries.status', 'accept')
            ->join('users', 'users.id', '=', 'galeries.id_user')
            ->leftJoin('likes', 'galeries.id', '=', 'likes.id_galery')
            ->select('galeries.*', 'users.username', 'users.profile')
            ->latest()
            ->get();

        dd($galery);
        $countlikes = Like::where('id_galery', $galery->id)->get();
        dd($countlikes);


        // $datausers = User::where('level',['user'])->get();
        // $users = User::where('id', $user->id)->first();
        return view('Page.timeline', compact('galery'));
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
        if (isset($request->foto)) {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:png,jpg,svg,gif'
            ]);

            if ($validator->fails()) {
                return back()->with('alert', 'Foto Tidak Memenuhi Format');
            }

            $nfile = $user->id . date('YmdHis') . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('image'), $nfile);

            $data = [
                'id_user' => $user->id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $nfile,
            ];

            Galery::create($data);

            return back()->with('success', 'Foto Sukses Untuk Di Upload');
        } else {
            $user = Auth::user();
            $data = [
                'id_user' => $user->id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            Galery::create($data);
            return back()->with('success', 'Foto Sukses Untuk Di Upload');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Galery::where('id', $id)->delete();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (isset($request->foto)) {
            $validator = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:png,jpg,svg,gif'
            ]);

            if ($validator->fails()) {
                return back()->with('alert', 'Foto Tidak Memenuhi Format');
            }

            $nfile = $user->id . date('YmdHis') . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('image'), $nfile);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $nfile,
            ];

            Galery::where('id', $id)->update($data);

            return back()->with('success', 'Foto Sukses Untuk Di Update');
        } else {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            Galery::where('id', $id)->update($data);

            return back()->with('success', 'Foto Sukses Untuk Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery)
    {
        //
    }
}
