<?php

namespace App\Http\Controllers;

use App\Models\Body;
use App\Models\Brake;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\Engine;
use App\Models\Form;
use App\Models\Image;
use App\Models\Models;
use App\Models\Product;
use App\Models\Salon;
use App\Models\Slider;
use App\Models\Suspension;
use App\Models\Transmission;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $products = Product::query()->where('status', 1)->inRandomOrder()->limit(8)->get();
        $brands = Brand::orderBy('title', 'ASC')->get();
        $models = Models::orderBy('title', 'ASC')->get();
        $categories = Category::orderBy('sort', 'ASC')->get();
        $wishlists = Wishlist::where('user_id', Auth::id())->get();

        return view('index', compact('products', 'brands', 'models', 'categories', 'sliders', 'wishlists'));
    }

    public function catalog(Request $request)
    {
        $paginate = 30;
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }
        if ($request->filled('oil')) {
            $query->where('oil', $request->oil);
        }
        if ($request->filled('oil')) {
            $query->where('oil', $request->oil);
        }
        if ($request->filled('volume_from')) {
            $query->where('volume', '>=', $request->volume_from);
        }
        if ($request->filled('volume_to')) {
            $query->where('volume', '<=', $request->volume_to);
        }
        if ($request->filled('steer')) {
            $query->where('steer', $request->steer);
        }
        if ($request->filled('drive')) {
            $query->where('drive', $request->drive);
        }
        if ($request->filled('mile_from')) {
            $query->where('mile', '>=', $request->mile_from);
        }
        if ($request->filled('mile_to')) {
            $query->where('mile', '<=', $request->mile_to);
        }
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $date = $date->format('Y-m-d');
        $query->where('dateLot', $date)->orderby('created_at', 'desc');

        $products = $query->paginate($paginate)
            ->withPath("?" . $request->getQueryString());

        $categories = Category::orderBy('sort', 'ASC')->get();

        return view('catalog', compact('products', 'categories'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        //$products = Product::where('category_id', )->
        return view('category', compact('category'));
    }
    public function brand($code)
    {
        $brand = Brand::where('code', $code)->first();
        return view('brand', compact('brand'));
    }

    public function model($code)
    {
        $model = Models::where('code', $code)->first();
        return view('model', compact('model'));
    }

    public function product($category, $productCode)
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $dateF = $date->format('Y-m-d');
        $product = Product::byCode($productCode)->firstOrFail();
        $images = Image::where('product_id', $product->id)->get();
        $related = Product::where('id', '!=', $product->id)->where('status', 1)->get();
        $engines = Engine::where('product_id', $product->id)->get();
        $transmissions = Transmission::where('product_id', $product->id)->get();
        $suspensions = Suspension::where('product_id', $product->id)->get();
        $brakes = Brake::where('product_id', $product->id)->get();
        $salons = Salon::where('product_id', $product->id)->get();
        $bodies = Body::where('product_id', $product->id)->get();
        return view('product', compact('product', 'images', 'related', 'engines', 'transmissions', 'suspensions', 'brakes', 'salons', 'bodies', 'date', 'dateF'));
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }

}
