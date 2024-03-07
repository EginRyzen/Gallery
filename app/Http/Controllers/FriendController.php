<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $pin = $request->pin;
        if (isset($pin)) {
            $search = User::where(function ($query) use ($pin) {
                $query->where('name', 'LIKE', '%' . $pin . '%')
                    ->orWhere('username', 'LIKE', '%' . $pin . '%');
            })
                ->where('level', 'user')
                ->where('status', 1)
                ->get()
                ->toArray();

            // dd($search);
            $result = array_column($search, 'id');
            $adds = User::whereIn('users.id', $result)
                ->leftJoin('friends', 'users.id', '=', 'friends.id_addto')
                ->select('users.*', 'friends.confirm', 'friends.id_add', 'friends.id_addto')
                ->get();

            // dd($adds);
            if ($adds) {
                // $friends = Friend::whereIn('id_addto', $adds->pluck('id')->toArray())
                //     ->where('id_add', Auth::user()->id)
                //     ->get();
                // $friends = Friend::whereIn('id_addto', $result)
                //     ->join('users', 'users.id', '=', 'friends.id_add')
                //     ->where('friends.id_add', $user->id)
                //     ->select('users.*', 'friends.confirm', 'friends.id_add', 'friends.id as idfriend')
                //     ->get();
                // if ($friends) {
                // dd($friends);
                return view('Page.addfriend.addfriend', compact('adds'));
                // } else {
                // $addme = Friend::where('id_add', $result)->where('id_addto', $result)->first();
                // dd($addme);
                //     return view('Page.addfriend.addfriend', compact('add', 'friends'));
                // }
            } else {
                return view('Page.addfriend.addfriend');
            }
        } else {
            return view('Page.addfriend.addfriend');
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
        $idaddto = $request->id_addto;
        $user = Auth::user();

        $data = [
            'id_addto' => $idaddto,
            'id_add' => $user->id,
        ];

        Friend::create($data);
        return redirect('timeline');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $friend = Friend::where('id', $id)->first();
        // dd($friend);

        $acc = [
            'confirm' => 'accept'
        ];
        Friend::where('id', $id)->update($acc);
        Friend::create([
            'id_add' => $user->id,
            'id_addto' => $friend->id_add,
            'confirm' => 'accept',
        ]);


        return back()->with('success', 'Success Your Confirm');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }

    public function daftarteman()
    {
        $user = Auth::user();

        // $galery = Galery::where('id_user', $user->id)->latest()->get();
        $users = User::where('id', $user->id)->first();
        $countfriends = Friend::where('id_add', $user->id)->where('confirm', 'accept')->get();

        $friendslist = Friend::join('users', 'users.id', '=', 'friends.id_add')
            ->where('friends.id_add', $user->id)
            ->where('friends.confirm', 'accept')
            ->get()
            ->toArray();
        $result = array_column($friendslist, 'id_addto');
        $friend = User::whereIn('id', $result)
            ->where('level', 'user')
            ->where('status', 1)
            ->get();
        // dd($friend);

        return view('Page.addfriend.daftarteman', compact('users', 'countfriends', 'friend'));
    }

    public function unFriend($id)
    {
        $user = Auth::user();

        Friend::where('id_add', $user->id)
            ->where('id_addto', $id)
            ->delete();
        Friend::where('id_addto', $user->id)
            ->where('id_add', $id)
            ->delete();

        return back();
    }
}
