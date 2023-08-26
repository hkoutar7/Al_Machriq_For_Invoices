<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaidNotif extends Notification implements ShouldQueue
{
    use Queueable;

    private string $URL;
    private string $invoice_name;

    public function __construct( string $URL, string $invoice_name )
    {
        $this->URL = $URL;
        $this->invoice_name = $invoice_name;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->markdown('mail.invoicePaid', ['url' => $this->URL,
            'invoice_name' => $this->invoice_name
        ])->subject('اشعار تسديد الفاتورة');
    }

    public function toArray(object $notifiable): array
    {
        return [

        ];
    }
}
