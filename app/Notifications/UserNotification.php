<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

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
        return [FcmChannel::class,'database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return FcmMessage
     */

    public function toFcm(mixed $notifiable): FcmMessage
    {
        return FcmMessage::create()
            ->setData([
                'user_id'=>$this->userData["user_id"]
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->userData['body'])
                ->setBody($this->userData["userText"],))
                //->setImage('http://example.com/url-to-image-here.png'))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }





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
    #[ArrayShape(['title' => "mixed", 'subject' => "mixed", 'user_id' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [
            //
            'title'=>$this->userData['body'],
            'subject'=>$this->userData["userText"],
            'user_id'=>$this->userData["user_id"]
        ];
    }




    #[ArrayShape(['title' => "mixed", 'subject' => "mixed", 'user_id' => "mixed"])]
    public function toBroadCast(mixed $notifiable): array
    {
        return [
            //
            'title'=>$this->userData['body'],
            'subject'=>$this->userData["userText"],
            'user_id'=>$this->userData["user_id"]
        ];
    }
}
