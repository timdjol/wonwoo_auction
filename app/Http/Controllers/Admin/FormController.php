<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $orders = Form::paginate(10);
        return view('auth.forms.index', compact('orders'));
    }

    public function destroy(Form $form)
    {
        $form->delete();
        session()->flash('success', 'Заявка ' . $form->name . ' удалена');
        return redirect()->route('forms.index');
    }
}

