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
        $data = $request->only(['email', 'password', 'age', 'city', 'district', 'name', 'avatar']);
        $user = User::where('email', $data['email'])->first();
        if ($user != null) {
            return response()->json(['message' => 'Email đã tồn tại'], 500);
        }
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('user/avatar', $request->file('avatar'));
            $fullPath = Storage::disk('public')->url($path);
            $data['avatar'] = $fullPath;
        }
        $data['status'] = 1;
        $data['role_id'] = 2;
        $data['city_id'] = $request->city;
        $data['district_id'] = $request->district;
        $data['name'] = $request->name;
        $data['age'] = $request->age;
        $data['password'] =  bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user);
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
        return response()->json(200);
    }
    public function unBlock($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();
        return response()->json(200);
    }
}
