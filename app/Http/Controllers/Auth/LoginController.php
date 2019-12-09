<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
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
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}