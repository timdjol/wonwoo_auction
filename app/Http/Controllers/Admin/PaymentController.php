<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;

class PaymentController
{
    public function index()
    {
        $payments = Payment::all();
        return view('auth.payments.index', compact('payments'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        session()->flash('success', 'Платеж ' . $payment->name . ' удален');
        return redirect()->route('payments.index');
    }
}