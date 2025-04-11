<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FatherReleases extends Notification
{
    use Queueable;

    protected string $title;
    protected string $message;
    protected array $emails;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $title, string $message, array $emails)
    {
        $this->title = $title;
        $this->message = $message;
        $this->emails = $emails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $emailList = implode(', ', $this->emails);

        return (new MailMessage)
            ->subject('New Release Notification')
            ->line($this->title)
            ->line($this->message)
            ->line('Emails of Fathers: ' . $emailList);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
