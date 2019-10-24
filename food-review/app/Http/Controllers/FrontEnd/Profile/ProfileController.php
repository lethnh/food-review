<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function myPostReview()
    {
        try {
            $id = Auth::id();
            Auth::user()->with('postReviews')->get();
            $post_reviews = PostReview::with('user');
            return $post_reviews;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();
        try {
            $path = $user->avatar;
            if ($request->hasFile('avatar')) {
                Storage::delete('public/' . $path);
                $path = Storage::disk('public')->put('user/' . $user->id . '/avatar', $request->file('avatar'));
                $fullPath = Storage::disk('public')->url($path);
                $user->update([
                    'avatar' => $fullPath,
                ]);
                return response()->json($user, 200);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function editUser(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
        ]);
     }
}
