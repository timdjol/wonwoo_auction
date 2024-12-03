<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\AuctionMail;
use App\Models\Category;
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


class OrderController extends Controller
{
    public function index()
    {
        //$orders = Order::orderBy('sum', 'desc')->get()->unique('product_id');
        $orders = Order::whereDate('created_at', today())->orderBy('created_at', 'desc')->get()->unique('product_id');
        return view('auth.orders.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Order $order)
    {
        $products = $order->products()->withTrashed()->get();
        return view('auth.orders.show', compact('order', 'products'));
    }


    public function edit(Order $order)
    {
        return view('auth.orders.form', compact('order'));
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, Order $order)
    {
        $params = $request->all();
        $order->update($params);
        session()->flash('success', 'Заказ ' . $request->name . ' обновлен');
        return redirect()->route('orders.index');
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success', 'Заказ ' . $order->name . ' удален');
        return redirect()->route('orders.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function dashboard()
    {
        $user = Auth::user();
        $categories = Category::get();
        $product = Product::get();
        $order = Order::get();
        $page = Page::get();
        $sliders = Slider::paginate(4);
        $form = Form::all();
        return view('auth.dashboard',
            compact('user', 'categories', 'product', 'order', 'page','sliders', 'form'));
    }

    public function sendEmail()
    {
        $orders = Order::whereDate('created_at', today())->orderBy('created_at', 'desc')->get()->unique('product_id');
        foreach ($orders as $user){
            Mail::to($user->email)->send(new AuctionMail($user));
        }
        session()->flash('success', 'Заявки победителям отправлены');
        return view('auth.orders.index', compact('orders'));
    }

}

