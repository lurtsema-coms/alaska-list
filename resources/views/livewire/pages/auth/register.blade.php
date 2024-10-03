<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.registration')] class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $contact_number = '';
    public string $home_address = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact_number' => ['required', 'string', 'max:255'],
            'home_address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'seller';
        $validated['status'] = 'ACTIVE';

        $user = User::create($validated);
        


        try{
            event(new Registered($user));
            Auth::login($user);
            // Use Livewire's redirectRoute method
            $this->redirectRoute('verification.notice');
        } catch(Throwable $e){
            $user->forceDelete();
            return redirect()->back()->with('error', 'Something went wrong. Please try again later...');
        }

    }
};
?>


<div>
    <div class="mb-5 text-center ">
        <h1 class=" text-3xl font-bold text-[#17427C] font-poppins">Registration Form</h1>
    </div>
    @if(session('error'))
    <div id="toast-danger" class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg shadow " role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg ">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="text-sm font-normal text-red-500 ms-3">{{ session('error') }}</div>
        {{-- <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button> --}}
    </div> 
    @endif
    <form wire:submit.prevent="register" class="text-[#17427C] space-y-5">
        <!-- Name -->
        <div class="flex flex-col gap-5 sm:flex-row">
            <div class="flex-1">
                <x-input-label for="first_name" :value="__('First Name:')" />
                <x-text-input wire:model="first_name" id="first_name" class="block w-full mt-1" type="text" name="first_name" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="last_name" :value="__('Last Name:')" />
                <x-text-input wire:model="last_name" id="last_name" class="block w-full mt-1" type="text" name="last_name" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-col gap-5 sm:flex-row">
            <div class="flex-1">
                <x-input-label for="email" :value="__('Email:')" />
                <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="contact_number" :value="__('Contact Number:')" />
                <x-text-input wire:model="contact_number" id="contact_number" class="block w-full mt-1" type="text" name="contact_number" required autocomplete="contact_number" />
                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div class="">
                <x-input-label for="home_address" :value="__('Home Address:')" />
                <x-text-input wire:model="home_address" id="home_address" class="block w-full mt-1" type="text" name="home_address" required autocomplete="home_address" />
                <x-input-error :messages="$errors->get('home_address')" class="mt-2" />
            </div>
        </div>


        <!-- Password -->
        <div class="flex flex-col gap-5 sm:flex-row">
            <div class="flex-1">
                <x-input-label for="password" :value="__('Password:')" />
                <x-text-input wire:model="password" id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="flex-1">
                <x-input-label for="password_confirmation" :value="__('Confirm Password:')" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="text-sm underline rounded-md text-cyan-600 hover:text-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                <span>
                    {{ __('Register') }}
                </span>
                <svg wire:loading class="w-5 h-5 ml-2 text-white animate-spin inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </x-primary-button>
        </div>
    </form>
</div>

