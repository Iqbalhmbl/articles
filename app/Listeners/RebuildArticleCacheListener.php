<?php

namespace App\Listeners;

use App\Events\RebuildArticleCache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RebuildArticleCacheListener
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
     * @param  \App\Events\RebuildArticleCache  $event
     * @return void
     */
    public function handle(RebuildArticleCache $event)
    {
        \Log::info('RebuildArticleCacheListener is triggered');
        // atau
        dd('RebuildArticleCacheListener is triggered');
    }
}
