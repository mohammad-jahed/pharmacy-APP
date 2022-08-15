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

class MedicineNotification extends Notification
{
    use Queueable;

    private array $medicineData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $medicineData)
    {
        //
        $this->medicineData = $medicineData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toFcm(mixed $notifiable): FcmMessage
    {
        return FcmMessage::create()
            ->setData([
                'medicine_id' => $this->medicineData['medicine_id']
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->medicineData['body'])
                ->setBody($this->medicineData['medicineText']))
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
            ->line($this->medicineData['body'])
            ->action($this->medicineData['medicineText'], $this->medicineData['medicineUrl'])
            ->line($this->medicineData['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    #[ArrayShape(['medicine' => "array", 'title' => "string", 'subject' => "mixed", 'medicine_id' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [

            'title' => $this->medicineData['body'],
            'subject' => $this->medicineData['medicineText'],
            'medicine_id' => $this->medicineData['medicine_id']
        ];
    }
}
