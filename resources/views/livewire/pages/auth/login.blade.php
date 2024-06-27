<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">

        <div class="mb-8">
            <div class="flex flex-col justify-center items-center mb-4">
                <h1 class="text-4xl font-extrabold text-cyan-800  sm:text-start font-poppins">LOGIN</h1>
            </div>
            <span class="font-bold">Doesn't have an account yet? <a href="/register" class="text-cyan-600 hover:text-cyan-500 underline font-bold">Sign Up</a></span>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label class="text-cyan-800 font-bold text-4xl" for="email" :value="__('Email:')" />
            <input wire:model="form.email" id="email" class="block px-1 py-1 w-full border-t-0 border-r-0 border-l-0 border-b-1 focus:border-cyan-800 focus:ring-red-50 focus:border-b-2 border-cyan-800 bg-gray-100" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="text-cyan-800 font-bold" for="password" :value="__('Password:')" />
            <input wire:model="form.password" id="password" class="block px-1 py-1 w-full border-t-0 border-r-0 border-l-0 border-b-1 focus:border-cyan-800 focus:ring-red-50 focus:border-b-2 border-cyan-800 bg-gray-100" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class=" mt-4 flex flex-col sm:flex-row gap-x-4 ">
            <label for="remember_me" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-cyan-800 shadow-sm focus:ring-cyan-800" name="remember">
                <span class="ms-2 text-sm text-cyan-800">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-cyan-600  hover:text-cyan-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-800" href="{{ route('password.request') }}" wire:navigate>
                {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-8">
            <x-primary-button class="w-full flex items-center h-12 justify-center">
                {{ __('Continue') }}
            </x-primary-button>
        </div>


    </form>
</div>
