<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brake;
use Illuminate\Support\Facades\Storage;

class BrakeController extends Controller
{
    public function destroy(Brake $brake)
    {
        $brake->delete();
        Storage::delete($brake);
        session()->flash('success', 'Image deleted');
        return redirect()->back();
    }
}
