<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logOut(Request $request)
    {
        if (Auth::check()) {
            $request->user()->token()->revoke();
            $request->user()->token()->delete();
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }
}
