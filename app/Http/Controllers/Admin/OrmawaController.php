<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ormawa;
use Illuminate\Http\Request;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['ormawas'] = Ormawa::all();
        return view('admin.ormawa.index')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ormawa $ormawa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ormawa $ormawa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ormawa $ormawa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ormawa $ormawa)
    {
        //
    }
}
