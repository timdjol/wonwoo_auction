<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Body;
use App\Models\Brake;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Engine;
use App\Models\Image;
use App\Models\Models;
use App\Models\Product;
use App\Models\Property;
use App\Models\Salon;
use App\Models\Sku;
use App\Models\Suspension;
use App\Models\Transmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(20);
        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::orderBy('title', 'ASC')->get();
        $models = Models::orderBy('title', 'ASC')->get();
        return view('auth.products.form', compact('categories', 'brands', 'models'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();

        unset($params['complex']);
        if($request->has('complex')){
            $params['complex'] = implode(', ', $request->complex);
        }


        unset($params['image']);
        if($request->has('image')){
            if($product->image != null) {
                Storage::delete($product->image);
            }
            $params['image'] = $request->file('image')->store('products');
        }

        //images
        $prod = Product::create($params);
        $images = $request->file('images');
        if ($request->hasFile('images')) :
            foreach ($images as $image):
                $image = $image->store('products');
                DB::table('images')->insert(
                    array(
                        'image'=>  $image,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //engines
        $engines = $request->file('engines');
        if ($request->hasFile('engines')) :
            foreach ($engines as $engine):
                $engine = $engine->store('engines');
                DB::table('engines')->insert(
                    array(
                        'image'=>  $engine,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //transmissions
        $transmissions = $request->file('transmissions');
        if ($request->hasFile('transmissions')) :
            foreach ($transmissions as $transmission):
                $transmission = $transmission->store('transmissions');
                DB::table('transmissions')->insert(
                    array(
                        'image'=>  $transmission,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //suspensions
        $suspensions = $request->file('suspensions');
        if ($request->hasFile('suspensions')) :
            foreach ($suspensions as $suspension):
                $suspension = $suspension->store('suspensions');
                DB::table('suspensions')->insert(
                    array(
                        'image'=>  $suspension,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //brakes
        $brakes = $request->file('brakes');
        if ($request->hasFile('brakes')) :
            foreach ($brakes as $brake):
                $brake = $engine->store('brakes');
                DB::table('brakes')->insert(
                    array(
                        'image'=>  $brake,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //salons
        $salons = $request->file('salons');
        if ($request->hasFile('salons')) :
            foreach ($salons as $salon):
                $salon = $salon->store('salons');
                DB::table('salons')->insert(
                    array(
                        'image'=>  $salon,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        //bodies
        $bodies = $request->file('bodies');
        if ($request->hasFile('bodies')) :
            foreach ($bodies as $body):
                $body = $body->store('bodies');
                DB::table('bodies')->insert(
                    array(
                        'image'=>  $body,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        session()->flash('success', 'Продукция ' . $request->title . ' добавлена');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $images = Image::where('product_id', $product->id)->get();
        return view('auth.products.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $models = Models::get();
        $complex = explode(', ', $product->complex);
        $images = Image::where('product_id', $product->id)->get();
        $engines = Engine::where('product_id', $product->id)->get();
        $transmissions = Transmission::where('product_id', $product->id)->get();
        $suspensions = Suspension::where('product_id', $product->id)->get();
        $brakes = Brake::where('product_id', $product->id)->get();
        $salons = Salon::where('product_id', $product->id)->get();
        $bodies = Body::where('product_id', $product->id)->get();
        session()->flash('success', 'Продукция ' . $product->title . ' добавлена');
        return view('auth.products.form', compact('product', 'categories', 'images', 'brands', 'models', 'complex', 'engines', 'transmissions', 'suspensions', 'brakes','salons', 'bodies'));
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();

        // complex
        unset($params['complex']);
        if($request->has('complex')){
            $params['complex'] = implode(', ', $request->complex);
        }

        unset($params['image']);
        if($request->has('image')){
            if($product->image != null) {
                Storage::delete($product->image);
            }
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }

        //images
        unset($params['images']);
        $images = $request->file('images');
        if ($request->hasFile('images')) :
            if($images != null) {
                Storage::delete($images);
                DB::table('images')->where('product_id', $product->id)->delete();
            }
            foreach ($images as $image):
                $image = $image->store('products');
                DB::table('images')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $image]);
            endforeach;
        endif;

        //engines
        unset($params['engines']);
        $engines = $request->file('engines');
        if ($request->hasFile('engines')) :
            if($engines != null) {
                Storage::delete($engines);
                DB::table('engines')->where('product_id', $product->id)->delete();
            }
            foreach ($engines as $engine):
                $engine = $engine->store('engines');

                DB::table('engines')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $engine]);
            endforeach;
        endif;

        //transmissions
        unset($params['transmissions']);
        $transmissions = $request->file('transmissions');
        if ($request->hasFile('transmissions')) :
            if($transmissions != null) {
                Storage::delete($transmissions);
                DB::table('transmissions')->where('product_id', $product->id)->delete();
            }
            foreach ($transmissions as $transmission):
                $transmission = $transmission->store('transmissions');
                DB::table('transmissions')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $transmission]);
            endforeach;
        endif;

        //suspensions
        unset($params['suspensions']);
        $suspensions = $request->file('suspensions');
        if ($request->hasFile('suspensions')) :
            if($images != null) {
                Storage::delete($images);
                DB::table('images')->where('product_id', $product->id)->delete();
            }
            foreach ($suspensions as $suspension):
                $suspension = $suspension->store('suspensions');
                DB::table('suspensions')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $suspension]);
            endforeach;
        endif;

        //brakes
        unset($params['brakes']);
        $brakes = $request->file('brakes');
        if ($request->hasFile('brakes')) :
            if($brakes != null) {
                Storage::delete($brakes);
                DB::table('brakes')->where('product_id', $product->id)->delete();
            }
            foreach ($brakes as $brake):
                $brake = $brake->store('brakes');
                DB::table('brakes')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $brake]);
            endforeach;
        endif;

        //salons
        unset($params['salons']);
        $salons = $request->file('salons');
        if ($request->hasFile('salons')) :
            if($salons != null) {
                Storage::delete($salons);
                DB::table('salons')->where('product_id', $product->id)->delete();
            }
            foreach ($salons as $salon):
                $salon = $salon->store('salons');
                DB::table('salons')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $salon]);
            endforeach;
        endif;

        //bodies
        unset($params['bodies']);
        $bodies = $request->file('bodies');
        if ($request->hasFile('bodies')) :
            if($bodies != null) {
                Storage::delete($bodies);
                DB::table('bodies')->where('product_id', $product->id)->delete();
            }
            foreach ($bodies as $body):
                $body = $body->store('bodies');
                DB::table('bodies')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $body]);
            endforeach;
        endif;

        $product->update($params);
        session()->flash('success', 'Продукция ' . $product->title . ' обновлена');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', 'Продукция ' . $product->title . ' удалена');
        return redirect()->route('products.index');
    }

}
