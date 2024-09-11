<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShopMail extends Mailable
{
    use Queueable, SerializesModels;

    public $auction;

    public function __construct($auction)
    {
        $this->auction = $auction;
    }

    public function build()
    {
        return $this->markdown('mail.shop_created')->subject('Покупка '. $this->auction->name.' создана' );
    }

}