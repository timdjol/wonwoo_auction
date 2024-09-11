<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest;
use App\Models\Brand;
use App\Models\Models;
use Illuminate\Support\Str;


class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Models::orderBy('title', 'ASC')->paginate(10);
        return view('auth.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('title', 'ASC')->get();
        return view('auth.models.form', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModelRequest $request)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        Models::create($params);

        session()->flash('success', 'Модель добавлена ' . $request->title);

        return redirect()->route('models.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Models $model)
    {
        $brands = Brand::orderBy('title', 'ASC')->get();
        return view('auth.models.form', compact('model', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelRequest $request, Models $model)
    {
        $params = $request->all();

        $model->update($params);

        session()->flash('success', 'Модель ' . $request->title . ' обновлена');
        return redirect()->route('models.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models $model)
    {
        $model->delete();
        session()->flash('success', 'Модель ' . $model->title . ' удалена');
        return redirect()->route('models.index');
    }
}
