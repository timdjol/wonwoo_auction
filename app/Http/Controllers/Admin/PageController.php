<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Support\Str;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('auth.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        Page::create($params);
        session()->flash('success', 'Страница ' . $request->title . ' добавлена');
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('auth.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('auth.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        $page->update($params);
        session()->flash('success', 'Страница ' . $page->title . ' обновлена');
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('success', 'Страница ' . $page->title . ' удалена');
        return redirect()->route('pages.index');
    }
}
