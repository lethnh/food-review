<?php

namespace App\Http\Controllers\Auth;

use App\Events\Reset_Password_Event;
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
                    // 'activation_token' => str_random(60)
                ]);
                $user->save();
                // $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
                // Storage::put('avatars/' . $user->id . '/avatar.png', (string) $avatar);
                // $user->notify(new SignupActivate($user));
                event(new Reset_Password_Event($user));
                return response()->json(['data' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => $th], 422);
        }
    }
}
