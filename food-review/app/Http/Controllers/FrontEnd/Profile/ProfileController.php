<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function myPostReview()
    {
        try {
            $id = Auth::id();
            Auth::user()->with('postReviews')->get();
            $post_reviews = PostReview::with('user')
            return $post_reviews;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
