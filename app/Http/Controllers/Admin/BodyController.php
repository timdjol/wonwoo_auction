<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Body;
use Illuminate\Support\Facades\Storage;

class BodyController extends Controller
{
    public function destroy(Body $body)
    {
        $body->delete();
        Storage::delete($body);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
