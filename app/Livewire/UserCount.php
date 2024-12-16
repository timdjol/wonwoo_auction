<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class UserCount extends Component
{
    public function render()
    {
        $cars = Order::orderBy('created_at', 'desc')->first();
        return view('livewire.user-count', [
            'users' => User::whereBetween('last_seen', [now()->subMinute(120), now()])->where('status', 1)
                ->count(),
        ]);

    }
}
