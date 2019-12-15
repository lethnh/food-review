<?php

namespace App\Listerners;

use App\Events\PostReviewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostReviewEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostReviewEvent  $event
     * @return void
     */
    public function handle(PostReviewEvent $event)
    {
        //
    }
}
