<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Checkout\Paid;

class CheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        $checkout->is_paid = true;
        $checkout->save();
        $request->session()->flash('success', "Checkout with {$checkout->User->name} has been updated!");

        // Send Email to User
        Mail::to($checkout->User->email)->send(new Paid($checkout));

        return redirect(route('admin.dashboard'));
    }
}
