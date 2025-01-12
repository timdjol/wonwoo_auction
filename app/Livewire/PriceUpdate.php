<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PriceUpdate extends Component
{
    public function render()
    {
        $contacts = Contact::first();
        $now = Carbon::parse(Carbon::now());
        $date = Carbon::parse($contacts->date_auc);
        $user_orders = Order::where('user_id', Auth::id())->orderBy('updated_at', 'desc')
            ->first();
        $orders = Order::orderBy('updated_at', 'desc')->first();
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'ASC')
            ->get();

        return view('livewire.price-update', [
            'cars' => $cars,
            'contacts' => $contacts,
            'now' => $now,
            'user_orders' => $user_orders,
            'orders' => $orders
        ]);
    }
}
