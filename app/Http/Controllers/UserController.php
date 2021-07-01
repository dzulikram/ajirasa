<?php

namespace App\Http\Controllers;

use App\HakAkses;
use App\Roles;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = user::where('pegawai',1)
            ->orderBy('id','desc')
            ->paginate();
        return view('app.users.users',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('app.users.users_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        User::create([
            'username' => $request->username,
            'nrp' => $request->username,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->username),
            'name' => $request->name,
            'pegawai' => 1
        ]);


        return redirect()
            ->route("user.index")
            ->with('success','Menambahkan data pengguna baru berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);

        return view('app.users.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {

    }

    /**
     * Change password method
     */

    public function change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:7'
        ]);

        $user = User::find(Auth::id());

        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->old_password)
            ]);
            $response = ['success','Sukses mengganti password, password berhasil dirubah'];
        }else{
            $response = ['success','Gagal mengganti password, password lama salah.'];
        }

        return redirect('change-password')
            ->with($response[0],$response[1]);
    }
}
