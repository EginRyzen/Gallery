<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        if (isset($id)) {
            // dd($request->input());
            if ($request->profile == null && $request->password == null) {
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                ];
                // dd($data);

                User::where('id', $id)->update($data);
                return back()->with('succes', 'Pr');
            }
            if ($request->profile && $request->password) {
                $nfile = $id . date('YmdHis') . '.' . $request->profile->getClientOriginalExtension();
                $request->profile->move(public_path('image'), $nfile);
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile' => $nfile,
                ];
                // dd($data);

                User::where('id', $id)->update($data);
                return back()->with('succes', 'Pr');
            }

            if ($request->password == null || $request->profile) {
                $nfile = $id . date('YmdHis') . '.' . $request->profile->getClientOriginalExtension();
                $request->profile->move(public_path('image'), $nfile);
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'profile' => $nfile,
                ];
                // dd($data);

                User::where('id', $id)->update($data);
                return back()->with('succes', 'Pr');
            }
            if ($request->profile == null || $request->password) {
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
                // dd($data);

                User::where('id', $id)->update($data);
                return back()->with('alert', 'Password Yang Anda Masukan Tidak Sama');
            }
        } else {
            $email = User::where('email', $request->email)->first();
            if ($email) {
                return back()->with('alert', 'Email Telah Terdaftar!!');
            }

            if ($request->password == $request->repassword) {
                // $pin = md5($request->email);
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
                // dd($data);

                User::create($data);

                return redirect('/')->with('success', 'Silahkan Tunggu Acc Admin Untuk Status');
            } else {
                return back()->with('alert', 'Password Yang Anda Masukan Tidak Sama');
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $email = User::where('email', $request->email)->where('status', 1)->first();
        if (!$email) {
            return back()->with('alert', 'Email Belum Terdaftar Atau User Belum Di Acc!!');
        }

        if (!Hash::check($request->password, $email->password)) {
            return back()->with('alert', 'Password Yang Anda Masukan Salah,Silahkan Cek Password Kembali!!');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect('admin');
            } else {
                return redirect('timeline');
            }
        } else {
            return back();
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
    public function profile()
    {
        $user = Auth::user();

        $galery = Galery::where('id_user', $user->id)->latest()->get();
        $fotos = Galery::where('id_user', $user->id)
            ->where('status', 'accept')
            ->latest()
            ->get();
        $users = User::where('id', $user->id)->first();
        $countfriends = Friend::where('id_add', $user->id)->where('confirm', 'accept')->get();

        $friends = Friend::join('users', 'users.id', '=', 'friends.id_add')
            ->where('friends.id_addto', $user->id)
            ->where('friends.confirm', ['pending'])
            ->select('users.*', 'friends.confirm', 'friends.id as idfriend')
            ->get();
        // dd($users);

        return view('Page.profile', compact('galery', 'users', 'friends', 'countfriends', 'fotos'));
    }

    public function profileUser($id)
    {
        $user = Auth::user();
        $galery = Galery::join('users', 'users.id', '=', 'galeries.id_user')
            ->where('galeries.id_user', $id)
            ->where('galeries.status', 'accept')
            ->select('galeries.*', 'users.username', 'users.profile')
            ->latest()
            ->get();
        $users = User::where('id', $id)->first();
        $countfriends = Friend::where('id_add', $id)->where('confirm', 'accept')->get();
        $friend = Friend::where('id_add', $id)
            ->where('id_addto', $user->id)
            ->where('confirm', 'accept')
            ->first();
        // dd($friend);

        return view('Page.addfriend.profileuser', compact('galery', 'users', 'countfriends', 'friend'));
    }
}
