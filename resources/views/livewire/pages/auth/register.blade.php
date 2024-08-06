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
        
        event(new Registered($user));

        Auth::login($user);

        // Use Livewire's redirectRoute method
        $this->redirectRoute('verification.notice');
    }
};
?>


<div>
    <div class="mb-5 text-center ">
        <h1 class=" text-3xl font-bold text-[#246567] font-poppins">Registration Form</h1>
    </div>
    <form wire:submit="register" class="text-[#246567] space-y-5">
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
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>

