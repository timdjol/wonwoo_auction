<?php

namespace App\Http\Controllers;

use App\Mail\AuctionMail;
use App\Mail\ShopMail;
use App\Models\Form;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuctionController extends Controller
{
    public function index($id)
    {
        $product = Product::where('id', $id)->get();
        return view('pages.auction', compact('id', 'product'));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        Order::create($params);
        Mail::to('info@wonwookorea.com')->send(new AuctionMail($request));
        session()->flash('success', 'Ваша ставка выставлена на сумму ' . $request->sum . 'сом');
        return back();
    }

    public function orderFormBuy(Request $request)
    {
        $params = $request->all();
        Form::create($params);
        Mail::to('info@wonwookorea.com')->send(new ShopMail($request));
        session()->flash('success', 'Ваша заявка на покупку принята!');
        return back();
    }

    public function deposit()
    {
        return view('pages.deposit');
    }

    public function deposit_success(Request $request)
    {
        return view('pages.deposit-success');
    }
}
