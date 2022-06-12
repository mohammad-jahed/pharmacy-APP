<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;

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
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
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
    #[ArrayShape(['prescription_id' => "mixed"])]
    public function toArray(mixed $notifiable): array
    {
        return [
            //
            'prescription_id' => $this->prescriptionData['prescription_id']
        ];
    }
}
