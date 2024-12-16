<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $orders = Form::orderBy('created_at', 'DESC')->paginate(20);
        return view('auth.forms.index', compact('orders'));
    }

    public function destroy(Form $form)
    {
        $form->delete();
        session()->flash('success', 'Заявка ' . $form->name . ' удалена');
        return redirect()->route('forms.index');
    }
}

