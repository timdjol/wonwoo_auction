<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transmission;
use Illuminate\Support\Facades\Storage;

class TransmissionController extends Controller
{
    public function destroy(Transmission $transmission)
    {
        $transmission->delete();
        Storage::delete($transmission);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
