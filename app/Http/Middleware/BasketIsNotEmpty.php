<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = session('order');
        if (!is_null($order) && $order->getFullSum() > 0) {
            return $next($request);
        }
        session()->forget('order');
        session()->flash('warning', __('basket.empty_cart'));
        return redirect()->route('index');
    }
}
