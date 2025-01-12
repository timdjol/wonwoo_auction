<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Engine;
use Illuminate\Support\Facades\Storage;

class EngineController extends Controller
{
    public function destroy(Engine $engine)
    {
        $engine->delete();
        Storage::delete($engine);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
