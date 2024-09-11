<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuctionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $auction;

    public function __construct($auction)
    {
        $this->auction = $auction;
    }

    public function build()
    {
        return $this->markdown('mail.auction_created')->subject('Аукцион '. $this->auction->name.' создан' );
    }

}