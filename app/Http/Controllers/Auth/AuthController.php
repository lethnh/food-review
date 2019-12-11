<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Models\OauthAccessToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

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
        $now = Carbon::now();
        $user = DB::table('oauth_access_tokens')->where('user_id', '=', Auth::id())->get();
        $time =  Carbon::parse($user['0']->expires_at);

        if (Auth::user() && $now < $time) {
            return response(['authenticated' => true]);
        }
        DB::table('oauth_access_tokens')->where('user_id', '=', Auth::id())->delete();
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
        }

        $this->incrementLoginAttempts($request);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id === 1) {
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
                    'expires_at' => $expiration,
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
