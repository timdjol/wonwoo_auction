<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuctionController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('sum', 'desc')->get()->unique('product_id');
        return view('auth.orders.index', compact('orders'));
    }

}
