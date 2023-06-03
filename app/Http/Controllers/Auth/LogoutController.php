<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'message' => 'Logout Berhasil',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('login')
            ->with($notification);
    }
}
