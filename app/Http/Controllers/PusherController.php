<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        $cars = Product::where('dateLot', '2024-11-04')->where('status', 1)->get();
        $cars = Product::where('dateLot', '2024-11-04')->where('status', 1)->get();
        $users = User::where('status', 1)->whereNotNull('last_seen')->get();
        return view('pages.socket', compact('cars', 'users'));
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        $message = $request->get('message');

        return view('pages.broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        $message = $request->get('message');
        return view('pages.receive', compact('message'));
    }

}
