<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function stock()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('sort', 'ASC')->get();
        return view('pages.stock', compact('products', 'categories'));
    }

    public function about()
    {
        $page = Page::where('id', 11)->firstOrFail();
        return view('pages.about', compact('page'));
    }

    public function contacts()
    {
        $contacts = Contact::get();
        return view('pages.contacts', compact('contacts'));
    }

    public function policy()
    {
        $page = Page::where('id', 8)->first();
        return view('pages.policy', compact('page'));
    }

    public function oferta()
    {
        $page = Page::where('id', 10)->first();
        return view('pages.oferta', compact('page'));
    }


    public function fetchState(Request $request)
    {
        $data['states'] = Region::where("country_id", $request->country_id)->get(["title", "id"]);
        return response()->json($data);
    }
}