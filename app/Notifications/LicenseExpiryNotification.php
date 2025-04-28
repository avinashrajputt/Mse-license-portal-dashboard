<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LicenseExpiryNotification extends Notification
{
    use Queueable;

    public $license;

    public function __construct($license)
    {
        $this->license = $license;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('License Expiry Reminder')
            ->line("Dear {$this->license->owner_name},")
            ->line("Your license ({$this->license->license_number}) for {$this->license->business_name} is about to expire on {$this->license->expiry_date}.")
            ->line('Please renew your license to avoid any disruptions.')
            ->action('Renew License', url('/licenses'))
            ->line('Thank you for using our portal!');
    }
}