<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function checkAdmin()
    {
        if (Auth::user() &&  Auth::user()->role_id == 1) {
            return response(['authenticated' => true]);
        }
        return response(['authenticated' => false]);
    }

    public function checkUser()
    {
        if (Auth::user()) {
            return response(['authenticated' => true]);
        }
        return response(['authenticated' => false]);
    }
}
