<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\AuctionMail;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Form;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AuctionController extends Controller
{
    public function index()
    {
        //$orders = Order::orderBy('sum', 'desc')->get()->unique('product_id');
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->pluck('id');
        $auctions = Auction::whereDate('created_at', today())->whereNot('product_id', null)->orderBy('created_at', 'desc')
            ->get()->unique('product_id');
        $last = Order::whereDate('created_at', '<', today())->whereNot('product_id', null)->orderBy('created_at', 'desc')
            ->get()->unique('product_id');
        return view('auth.orders.index', compact('auctions', 'last', 'cars', 'contacts'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Auction $auction)
    {
        return view('auth.orders.show', compact('auction'));
    }


    public function edit(Auction $auction)
    {
        return view('auth.orders.form', compact('auction'));
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, Auction $auction)
    {
        $params = $request->all();
        $auction->update($params);
        session()->flash('success', 'Аукцион ' . $request->name . ' обновлен');
        return redirect()->route('auctions.index');
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Auction $auction)
    {
        $auction->delete();
        session()->flash('success', 'Аукцион ' . $auction->name . ' удален');
        return redirect()->route('orders.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */

    public function sendEmail()
    {
        //$orders = Order::whereDate('created_at', today())->orderBy('created_at', 'desc')->get()->unique('product_id');
        $orders = Auction::whereDate('created_at', today())->whereNot('product_id', null)->orderBy('sum', 'desc')->get()
            ->unique('product_id');
        foreach ($orders as $user){
            Mail::to($user->email)->send(new AuctionMail($user));
            //$user::latest()->skip(1)->delete();
            $user->update([
                'status' => 1,
            ]);
        }
        $products = Product::paginate(20);
        session()->flash('success', 'Заявки победителям отправлены');
        return view('auth.products.index', compact('products'));
    }

}

