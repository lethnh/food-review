<?php

namespace App\Http\Controllers\Auth;

use App\Events\Reset_Password_Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function forgotPassword(Request $request)
    {
        try {
            //code...
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            $user->token_reset = Hash::make(Str::random(60));
            $user->save();
            event(new Reset_Password_Event($user));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $token                        = $request->only('token')['token'];
            $password_reset               = User::where('token_reset', $token)->first();
            if (empty($password_reset)) {
                throw  new  \Exception('The path does not exist');
            }
            $user                         = User::where('email', $password_reset->email)->first();
            $data                         = $request->only('password');
            $data['password']             = \Illuminate\Support\Facades\Hash::make($data['password']);
            $user->fill($data)->save();
            return response()->json(['data' => "The password has been successfully changed"]);
        } catch (\Exception $e) {
            return $this->errorResponse([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
