<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('title', 'ASC')->paginate(10);
        return view('auth.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.brands.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        Brand::create($params);

        session()->flash('success', 'Бренд добавлен ' . $request->title);

        return redirect()->route('brands.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('auth.brands.form', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $params = $request->all();

        $brand->update($params);

        session()->flash('success', 'Бренд ' . $request->title . ' обновлен');
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        session()->flash('success', 'Бренд ' . $brand->title . ' удален');
        return redirect()->route('brands.index');
    }
}
