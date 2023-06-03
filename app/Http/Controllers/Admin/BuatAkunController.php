<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BuatAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUser()
    {
        return User::where('role_id', 2)->get();
    }
    public function getOneUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function index()
    {
        $data['users'] = $this->getUser();
        return view('admin.buat_akun.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt('gbghfd65#2w45'.$request->password.'sdghgh^$^');
        try {
            $data['role_id'] = 2;
            User::create($data);
            $notification = [
                'message' => 'Berhasil Membuat Akun',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->getOneUser($id)->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
