<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class CountDown extends Component
{

    public function render()
    {
        $order = \App\Models\Order::orderBy('created_at', 'desc')->first();
        $contact = Contact::where('id', 1)->first();
        return view('livewire.count-down', [
            'order' => $order,
            'contact' => $contact
        ]);
    }
}
