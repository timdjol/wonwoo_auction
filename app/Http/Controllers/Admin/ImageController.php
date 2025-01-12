<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create(Image $image)
    {
        return view('auth.products.form', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Product $product
     */
    public function store(Request $request, Image $image, Product $product){
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        Image::create($params);
        session()->flash('success', $request->product->title . ' добавлен' );
        return redirect()->route('rooms.index', $product);
    }

    public function destroy(Image $image)
    {
        $image->delete();
        Storage::delete($image);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
