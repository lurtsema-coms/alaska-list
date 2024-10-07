<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\SpecialBoost;
use App\Traits\ListingOption;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;


class CheckoutPaymentController extends Controller
{
    use WithFileUploads;
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

    public function paymentAdSuccess()
    {
        $checkoutData = session('checkout_data');
    
        if (!$checkoutData) {
            return auth()->check() ? redirect()->route('seller-featured-listing') : redirect('/login');
        }
    
        if ($this->isPaymentSuccessful($checkoutData)) {
            $uuid = 'ad-' . substr(Str::uuid()->toString(), 0, 8);
            $photo_path = $checkoutData['photo_path']; // Retrieve the file path
    
            // Create the advertisement record
            $sp = Advertisement::create([
                'uuid' => $uuid,
                'advertising_plan_id' => $checkoutData['advertising_plan_id'],
                'from_date' => $this->formatIso($checkoutData['from_date']),
                'to_date' => $this->formatIso($checkoutData['to_date']),
                'product_id' => $checkoutData['product_id'],
                'created_by' => auth()->user()->id,
            ]);
    
            // Handle the file upload
            if (!empty($photo_path)) {
                $photo = storage_path("app/" . $photo_path); // Path to the temporary file
                $file_name = "$uuid." . pathinfo($photo, PATHINFO_EXTENSION);
    
                // Move the file to the public directory
                $destination = "public/photos/advertisement/$file_name";
                Storage::move($photo_path, $destination);
    
                // Optimize the image
                $image = Image::make(storage_path("app/" . $destination));
                $image->resize(320, 600)->save(storage_path("app/" . $destination), 80);
    
                $sp->update([
                    'file_name' => $file_name,
                    'file_path' => "storage/photos/advertisement/$file_name",
                ]);
            }
    
            // Clear the session data
            session()->forget('checkout_data');
    
            // Return success view
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
    public function paymentAdCancel()
    {
            session()->forget('checkout_data');

            if (auth()->check()) {
                return view('checkout-cancel-ad');
            } else {
                return redirect('/login');
            }
    }

    private function isPaymentSuccessful($checkoutData)
    {
        return true;
    }
}
