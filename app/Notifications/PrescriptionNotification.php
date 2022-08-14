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

class PrescriptionNotification extends Notification
{
    use Queueable;

    private array $prescriptionData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $prescriptionData)
    {
        //
        $this->prescriptionData = $prescriptionData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return [FcmChannel::class,'database'];
    }

    public function toFcm(mixed $notifiable): FcmMessage
    {
        return FcmMessage::create()
            ->setData([
                'user_id'=>'uuuuu'
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('ttt')
                ->setBody('bbbb'))
            //->setImage('http://example.com/url-to-image-here.png'))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
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
            ->line($this->prescriptionData['body'])
            ->action($this->prescriptionData['prescriptionText'], $this->prescriptionData['prescriptionUrl'])
            ->line($this->prescriptionData['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    #[ArrayShape(['title' => "mixed", 'prescription_id' => "mixed", 'subject' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [
            //
            'title'=>$this->prescriptionData['body'],
            'prescription_id'=>$this->prescriptionData['prescription_id'],
            'subject'=>$this->prescriptionData['prescriptionText'],
        ];
    }
}
