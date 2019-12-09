<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GetUserController extends Controller
{
    public function getUser()
    {
        try {
            $user = Auth::user();
            $user->city;
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getPostReview()
    {
        $user_id = Auth::id();
        $post_review = PostReview::where('user_id', $user_id)->orderBy('created_at')->paginate(5);
        return response()->json($post_review, 200);
    }

    public function getUsers()
    {
        $users = DB::table('users')->join('cities', 'users.city_id', '=', 'cities.id')
            ->select('users.*', 'cities.name as city_name')
            ->where('role_id', 2)
            ->where('status', 0)
            ->paginate(5);
        return response()->json($users, 200);
    }
}
