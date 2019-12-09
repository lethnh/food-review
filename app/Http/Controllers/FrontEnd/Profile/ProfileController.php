<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use App\Events\Reset_Password_Event;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
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
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'address' => $request->address,
            'city_id' => $request->city_id,
        ]);
        $user->save();
        event(new Reset_Password_Event($user));
        return response()->json($user, 200);
    }

    public function getComment()
    {
        $user_id = Auth::id();
        $comments = Comment::where('user_id',$user_id)->with('postReview')->orderBy('created_at','DESC')->paginate(5);
        return response()->json($comments, 200);
    }
}
