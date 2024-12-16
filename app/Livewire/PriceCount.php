<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PriceCount extends Component
{
    public function render()
    {
        $contacts = Contact::first();
        $now = Carbon::parse(Carbon::now());
        $date = Carbon::parse($contacts->date_auc);
        $orders = Order::orderBy('updated_at', 'desc')->first();

        return view('livewire.price-update', [
            'cars' => $car,
            'contacts' => $contacts,
            'now' => $now,
            'user_orders' => $user_orders,
            'orders' => $orders
        ]);
    }
}
