<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

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

    public function getAdmin()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function loginAdmin(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only('email', 'password');


        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            // return response()->json('');
            // throw new HttpResponseException()(response()->json(
            //     [
            //         'error' => 'Tài khoản của bạn bị khóa',
            //         'status_code' => 422,
            //     ],
            //     JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            // ));
        }

        $this->incrementLoginAttempts($request);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id === 1) {

                // if ($user->clients->count() !== 0) {
                //     $user->clients->expried_at
                //     return response()->json(['message' => 'Đăng nhập hết hạn'],401);
                // }
                $tokenResult = $user->createToken('Personal Access Token');
                $access_token = $tokenResult->accessToken;
                $token = $tokenResult->token;
                if ($request->remember_me) {
                    $token->expires_at = Carbon::now()->addWeeks(1);
                } else {
                    $token->expires_at = Carbon::now()->addMinutes(1);
                }
                $token->save();
                $expiration = $tokenResult->token->expires_at->diffInSeconds(Carbon::now());

                return response()->json([
                    'user_info' => $user,
                    'access_token' => $access_token,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    // 'info' => 
                ]);
            } else {
                return response()->json(['error' => 'Unauthorised'], 500);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
