<?php

namespace App\Notifications;

use App\Models\Medicine;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MedicineReminderNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Medicine $medicine
    ) {}

    /**
     * Delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Email notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('⏰ Medicine Reminder - ' . $this->medicine->name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line("It's time to take your medicine.")
            ->line('Medicine: ' . $this->medicine->name)
            ->line('Description: ' . $this->medicine->description)
            ->line('Please take your medicine as prescribed.')
            ->action('Open Dashboard', url('/dashboard'))
            ->line('Stay healthy!')
            ->salutation('Regards, MedRemind Team');
    }

    /**
     * Database notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'medicine_id' => $this->medicine->id,
            'medicine_name' => $this->medicine->name,
            'message' => 'Medicine reminder sent',
        ];
    }
}
