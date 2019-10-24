<?php

namespace App\Http\Controllers\FrontEnd\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment_like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
	public function likeComment(Request $request, $comment_id)
	{
		// try {
		// 	//code...
		// 	$status =  $request->input('status');
		// 	$like = Comment_like::create([
		// 		'status' => $status,
		// 		'comment_id' => $id,
		// 		'user_id' => Auth::id(),
		// 	]);
		// 	return response()->json($like, 200);
		// } catch (\Throwable $th) {
		// 	//throw $th;
		// }

		$userId = Auth::id();
		$status =  $request->input('status');
		/* Get item's current like, dislike total */
		// $totalLike = TotalLike::where('item_id', $comment_id)->first();
		/* Get user's vote on this item */
		$like = Comment_like::where(['user_id' => $userId, 'comment_id' => $comment_id])->first();
		/* Check if users vote on this item exists */
		if ($like != null) {
			if ($like->status === 1) {	// if previous vote was like
				// $totalLike->total_like--;	// decrease item's total like by 1
				// $totalLike->total_like = $totalLike->total_like == null ? 0 : $totalLike->total_like;	// set 0 if total like is null
				if ($status === 1) {	// if current vote is like
					$status = 0;	// previous vote and current vote is same so discarde vote
				}
			} else if ($like->status === 0) {	// if previous vote was dislike
				// $totalLike->total_dislike--;	// decrease item's total like by 1
				// $totalLike->total_dislike = $totalLike->total_dislike == null ? 0 : $totalLike->total_dislike;	// set 0 if total dislike is null
				if ($status == 0) {	// if current vote is dislike
					$status = 0;	// previous vote and current vote is same so discarde vote
				}
			}
		} else {
			$like = new Comment_like;	// create new like object if previous vote not exists
		}
		/* Update vote data */
		$like->user_id = $userId;
		$like->comment_id = $comment_id;
		$like->status = $status;
		// if ($status == 1) {
		// 	$totalLike->total_like++;	// increase total like if vote is like
		// } else if ($status == -1) {
		// 	$totalLike->total_dislike++;	// increase total dislike if vote is dislike
		// }
		$like->save();		// save like
		// $totalLike->save();	//save total like,dislike


	}
}
