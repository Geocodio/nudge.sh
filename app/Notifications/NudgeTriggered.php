<?php

namespace App\Notifications;

use App\Nudge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class NudgeTriggered extends Notification implements ShouldQueue
{
    use Queueable;

    private $nudge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Nudge $nudge)
    {
        $this->nudge = $nudge;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            TwilioChannel::class,
        ];
    }

    public function toTwilio($notifiable)
    {
        $message = 'Your command-line task completed.';

        if (strlen($this->nudge->output) > 0) {
            $message .= ' See output at: '.url('output/'.$this->nudge->slug);
        } else {
            $message .= ' No output was captured.';
        }

        return (new TwilioSmsMessage())
            ->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
