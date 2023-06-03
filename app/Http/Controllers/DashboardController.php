<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ormawa;
use Auth;
use App\Models\Pengajuan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 1){
            $data['ormawas'] = Ormawa::all();
            $data['pengajuans'] = Pengajuan::where('status_pengajuan', 2)->get();
            $data['users'] = Pengajuan::all();
            return view('admin.dashboard.index')->with($data);
        }elseif(Auth::user()->role_id == 2){
            return view('user.dashboard.index');
        }else{
            return redirect()->route('landing');
        }
    }
}
