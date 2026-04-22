<?php

namespace App\Listeners;

use App\Events\MergeCartEvent;
use App\Services\Cart\SessionCartService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct(public SessionCartService $sessionCartService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MergeCartEvent $event): void
    {
        $this->sessionCartService->mergeGuestCartToUser($event->user);
    }
}
