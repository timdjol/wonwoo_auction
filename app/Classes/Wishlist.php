<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Wishlist
{
    public function __construct($createWishlist = false){
        $order = session('wishlist');

        if (is_null($order) && $createWishlist) {
            $data = [];
            if(Auth::check()){
                $data['user_id'] = Auth::id();
            }
            $this->order = new Order($data);
            session(['wishlist' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    public function getWishlist(){
        return $this->order;
    }

    public function removeWishlist (Product $product){

        if ($this->order->contains($product)) {
            session()->forget('wishlist');
            return redirect()->route('index');
        }
    }

    public function addWishlist(Product $product){
        if ($this->order->products->contains($product)) {
            $pivotRow = $this->order->where('id', $product->id)->first();
            if($pivotRow->countInOrder >= $product->count){
                return false;
            }
        } else {
            if($product->count == 0){
                return false;
            }
            $product->countInOrder = 1;
            $this->order->push($product);
        }

        return true;
    }
}