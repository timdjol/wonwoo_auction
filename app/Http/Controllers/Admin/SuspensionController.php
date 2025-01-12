<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suspension;
use Illuminate\Support\Facades\Storage;

class SuspensionController extends Controller
{
    public function destroy(Suspension $suspension)
    {
        $suspension->delete();
        Storage::delete($suspension);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
