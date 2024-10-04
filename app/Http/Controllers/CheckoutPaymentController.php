<?php

namespace App\Http\Controllers;

use App\Models\SpecialBoost;
use App\Traits\ListingOption;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutPaymentController extends Controller
{
    use ListingOption;

    public function paymentSuccess()
    {
        // Retrieve checkout data from the session
        $checkoutData = session('checkout_data');
        
        // Check if checkout data exists
        if (!$checkoutData) {
            if (auth()->check()) {
                return redirect()->route('seller-special-boost');
            } else {
                return redirect('/login');
            }
        }

        if ($this->isPaymentSuccessful($checkoutData)) {
            // Create the special boost record
            SpecialBoost::create([
                'uuid' => 'boost-code-' . substr(Str::uuid()->toString(), 0, 10),
                'product_id' => $checkoutData['product_id'],
                'advertising_plan_id' => $checkoutData['advertising_plan_id'],
                'from_date' => $this->formatIso($checkoutData['from_date']),
                'to_date' => $this->formatIso($checkoutData['to_date']),
                'created_by' => auth()->user()->id,
            ]);

            // Clear the session data if needed
            session()->forget('checkout_data');

            // Return the success view
            return view('checkout-success', compact('checkoutData'));
        }
    }

    public function paymentCancel()
    {
            session()->forget('checkout_data');

            if (auth()->check()) {
                return view('checkout-cancel');
            } else {
                return redirect('/login');
            }
    }

    private function isPaymentSuccessful($checkoutData)
    {
        return true;
    }
}
