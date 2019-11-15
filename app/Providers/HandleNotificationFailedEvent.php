<?php

namespace App\Providers;

use App\Providers\Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleNotificationFailedEvent
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
     * @param  NotificationFailed  $event
     * @return void
     */
    public function handle(NotificationFailed $event)
    {
        info('Notification failed: ' . ($event->data['message'] ?? 'Unknown error'))
    }
}
