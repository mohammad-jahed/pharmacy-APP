<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;

class ReservationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private array $reservationData;


    public function __construct(array $reservationData)
    {
        //
        $this->reservationData = $reservationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    #[ArrayShape(['title' => "mixed", 'subject' => "mixed", 'user_id' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [
            //
            'title'=>$this->reservationData['body'],
            'subject'=>$this->reservationData["reservationText"],
            'user_id'=>$this->reservationData["reservation_id"]
        ];
    }


}
