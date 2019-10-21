<?php

namespace App\Http\Controllers\FrontEnd\Comment;

use App\Comment_like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    public function likeComment(Request $request, $id)
    {
        try {
            //code...
            $status =  $request->input('status');
            $like = Comment_like::create([
                'status' => $status,
                'comment_id' => $id,
                'user_id' => Auth::id(),
            ]);
            return response()->json($like,200);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $userId = Auth::id();
    	$itemId = $request->item_id;
    	$vote = $request->vote;
    	/* Get item's current like, dislike total */
    	$totalLike = TotalLike::where('item_id', $itemId)->first();
    	/* Get user's vote on this item */
		$like = Like::where(['user_id' => $userId, 'item_id' => $itemId])->first();
		/* Check if users vote on this item exists */
		if ($like != null) {
			if ($like->vote == 1) {	// if previous vote was like
				$totalLike->total_like--;	// decrease item's total like by 1
				$totalLike->total_like = $totalLike->total_like == null ? 0 : $totalLike->total_like;	// set 0 if total like is null
				if ($vote == 1) {	// if current vote is like
					$vote = 0;	// previous vote and current vote is same so discarde vote
				}
			} else if ($like->vote == -1) {	// if previous vote was dislike
				$totalLike->total_dislike--;	// decrease item's total like by 1
				$totalLike->total_dislike = $totalLike->total_dislike == null ? 0 : $totalLike->total_dislike;	// set 0 if total dislike is null
				if ($vote == -1) {	// if current vote is dislike
					$vote = 0;	// previous vote and current vote is same so discarde vote
				}
			}
		} else {
			$like = new Like;	// create new like object if previous vote not exists
		}
		/* Update vote data */
		$like->user_id = $userId;
		$like->item_id = $itemId;
		$like->vote = $vote;
		if ($vote == 1) {
			$totalLike->total_like++;	// increase total like if vote is like
		} else if ($vote == -1) {
			$totalLike->total_dislike++;	// increase total dislike if vote is dislike
		}
		$like->save();		// save like
		$totalLike->save();	//save total like,dislike


    }
}
