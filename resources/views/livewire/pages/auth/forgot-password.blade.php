<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="font-bold text-[#17427C] " :value="__('Email:')" />
            <input wire:model="email" id="email" type="email" name="email" required autofocus class="block w-full px-1 py-1 border-t-0 border-l-0 border-r-0 border-b-1 focus:border-[#17427C] focus:ring-gray-50 focus:border-b-2 border-[#17427C] bg-gray-50" />
            {{-- <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autofocus /> --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-end gap-2 mt-4">
            <a href="{{ route('login') }}" wire:navigate>
                <div class="px-4 py-2 text-xs bg-white border">
                    BACK
                </div>
            </a>
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div>
