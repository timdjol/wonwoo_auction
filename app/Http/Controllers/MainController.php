<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\ShopMail;
use App\Models\Body;
use App\Models\Brake;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Engine;
use App\Models\Form;
use App\Models\Image;
use App\Models\Models;
use App\Models\Order;
use App\Models\Product;
use App\Models\Salon;
use App\Models\Slider;
use App\Models\Suspension;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $products = Product::query()->inRandomOrder()->limit(8)->get();
        $brands = Brand::orderBy('title', 'ASC')->get();
        $models = Models::orderBy('title', 'ASC')->get();
        $categories = Category::orderBy('sort', 'ASC')->get();

        return view('index', compact('products', 'brands', 'models', 'categories', 'sliders'));
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

        $products = $query->orderby('created_at', 'desc')->paginate($paginate)
            ->withPath("?" . $request->getQueryString());

        $categories = Category::orderBy('sort', 'ASC')->get();

        return view('catalog', compact('products', 'categories'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
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
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        $images = Image::where('product_id', $product->id)->get();
        $related = Product::where('id', '!=', $product->id)->get();
        $engines = Engine::where('product_id', $product->id)->get();
        $transmissions = Transmission::where('product_id', $product->id)->get();
        $suspensions = Suspension::where('product_id', $product->id)->get();
        $brakes = Brake::where('product_id', $product->id)->get();
        $salons = Salon::where('product_id', $product->id)->get();
        $bodies = Body::where('product_id', $product->id)->get();
        return view('product', compact('product', 'images', 'related', 'engines', 'transmissions', 'suspensions', 'brakes', 'salons', 'bodies'));
    }

    public function search()
    {
        $title = $_GET['search'];
        $search = Product::query()
            ->where('title', 'like', '%' . $title . '%')
            ->get();
        return view('search', compact('search'));
    }

    public function contactpage()
    {
        return view('pages.form');
    }

    public function contactform(Request $request)
    {
        $params = $request->all();
        Form::create($params);
        Mail::to('info@wonwookorea.com')->send(new ContactMail($request));
        session()->flash('success', 'Ваша заявка отправлена!');
        return back();
    }

}
