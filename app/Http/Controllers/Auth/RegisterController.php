<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'check_code' => '',
                // 'activation_token' => str_random(60)
            ]);
            $user->save();
            event(new RegisterEvent($user));
            return response()->json(['data' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th], 422);
        }
    }
}
