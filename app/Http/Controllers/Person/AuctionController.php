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
        $orders = Order::where('user_id', Auth::id())->where('status', 1)->orderBy('sum', 'desc')->get()->unique('product_id');
        //$orders = Order::where('status', 1)->orderBy('created_at', 'desc')->get()->unique('product_id');
        return view('auth.orders.index', compact('orders'));
    }

}
