<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Models\User;

class PersyaratanController extends Controller
{
    public function persyaratan(Request $request)
    {
        $id = Auth::user()->id;
        try {
            if(!$request->syarat){
                throw new Exception("Persyaratan harus diceklis");
            }
            User::where('id', $id)->update([
                'status_pendaftaran' => $request->syarat
            ]);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Berhasil',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }
}
