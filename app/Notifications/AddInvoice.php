<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoice extends Notification implements ShouldQueue

{
    use Queueable;

    private string $name;
    private  $invoice_created;
    private string $invoice_name;
    private string $inv_id;

    public function __construct($inv_id,$name, $invoice_created,$invoice_name)
    {
        $this->name = $name;
        $this->invoice_created = $invoice_created;
        $this->invoice_name = $invoice_name;
        $this->inv_id = $inv_id;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->name,
            'date_invoice' => $this->invoice_created,
            'invoiceName' =>$this->invoice_name,
            'invoiceId' =>$this->inv_id,
        ];
    }
}
