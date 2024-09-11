<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $user = Auth::id();
        $prod_ids = Wishlist::where('user_id', $user)->get();
        return view('wishlist', compact('prod_ids'));
    }

    public function wishlistAdd(Product $product)
    {
        Wishlist::create([
            'product_id' => $product->id,
            'user_id' => Auth::id()
        ]);
        session()->flash('success', $product->title . ' добавлен');
        return back();
    }

    public function wishlistRemove(Product $product)
    {
        Wishlist::where('product_id', $product->id)->where('user_id', Auth::id())->delete();
        session()->flash('success', 'Избранное удалено');
        return back();
    }

}
