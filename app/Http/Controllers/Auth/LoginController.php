<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
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

    public function login(UserRequest $request)
    {
        $this->validateLogin($request);
        $credentials = $request->only('email', 'password');
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
        }
        $this->incrementLoginAttempts($request);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return response()->json(['errors' => ['email' => ['Email không tồn tại']]], 500);
        }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $access_token = $tokenResult->accessToken;
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            } else {
                $token->expires_at = Carbon::now()->addDays(1);
            }
            $token->save();
            $expiration = $tokenResult->token->expires_at->diffInSeconds(Carbon::now());
            unset($user->post_reviews);

            return response()->json([
                'user_info' => $user,
                'access_token' => $access_token,
                'token_type' => 'Bearer',
                'expires_at' => $expiration,
                // 'info' => 
            ]);
        } else {
            return response()->json(['errors' => ['password' => ['Password nhập vào không đúng']]], 500);
        }
    }
}
