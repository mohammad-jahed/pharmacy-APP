<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;

class UserNotification extends Notification
{
    use Queueable;

    private array $userData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $userData)
    {
        //
        $this->userData = $userData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->userData['body'])
            ->action($this->userData['userText'], $this->userData['userUrl'])
            ->line($this->userData['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    #[ArrayShape(['user' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [
            //
            //'user' => $this->userData
            //$this->userData,
            'title'=>"you have a new user registered",
            'subject'=>$this->userData["userText"],
            'user_id'=>$this->userData["user_id"]
        ];
    }
}
