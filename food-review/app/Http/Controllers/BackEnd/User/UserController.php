<?php

namespace App\Http\Controllers\BackEnd\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only(['email', 'password', 'age', 'city', 'district', 'name']);
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('user/avatar', $request->file('avatar'));
            $fullPath = Storage::disk('public')->url($path);
            $data['avatar'] = $fullPath;
        }
        $data['status'] = 1;
        $data['password'] =  bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user);
    }

    public function block($id)
    {
        
    }
}
