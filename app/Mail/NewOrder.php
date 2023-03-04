<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $orderNumber;
    public $name;
    public $phone;
    public $address;
    public $product;
    public $total_price;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $address, $orderNumber, $product, $total_price, $user)
    {
        $this->orderNumber = $orderNumber;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->product = $product;
        $this->total_price = $total_price;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.newOrder');
    }
}
