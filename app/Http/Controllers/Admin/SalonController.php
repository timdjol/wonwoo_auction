<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use Illuminate\Support\Facades\Storage;

class SalonController extends Controller
{
    public function destroy(Salon $salon)
    {
        $salon->delete();
        Storage::delete($salon);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
