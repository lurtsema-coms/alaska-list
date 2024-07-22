<?php

use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;

new class extends Component {
    public $first_name = '';
    public $last_name = '';
    public $contact_number = '';
    public $home_address = '';
    #[Validate('required|unique:users,email')]
    public $email = '';
    public $role = '';
    #[Validate('confirmed')]
    public $password = '';
    public $password_confirmation = '';
    public $add_user_modal = false;

    function saveCategory()
    {
        $this->validate();

        User::create([
            'first_name' => trim($this->first_name),
            'last_name' => trim($this->last_name),
            'status' => 'ACTIVE',
            'contact_number' => trim($this->contact_number),
            'home_address' => $this->home_address,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'created_by' => auth()->user()->id 
        ]);

        $this->resetData(['first_name', 'last_name', 'email', 'home_address', 'contact_number', 'role', 'password', 'password_confirmation']);

        $this->add_user_modal = false;
        $this->dispatch('alert-success');
    }

    function resetData($data)
    {
        $this->reset($data);
    }
}; ?>

<div 
    x-data="{ add_user_modal: $wire.entangle('add_user_modal') }" x-init="$watch('add_user_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="add_user_modal=true">
        Add User
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="add_user_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="add_user_modal=false; $wire.call('resetData', ['first_name', 'last_name', 'email', 'home_address', 'contact_number', 'role', 'password', 'password_confirmation'])">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="saveCategory">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Add User</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">First Name</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="first_name">
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Last Name</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="last_name">
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Email</p>
                                        <input
                                            class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                            type="email"
                                            wire:model="email"
                                            required>
                                        <div class="text-sm text-red-500">@error('email') {{ $message }} @enderror</div>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Contact Number</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="contact_number">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Home Address</p>
                                    <input
                                        class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                        type="text"
                                        wire:model="home_address"
                                        required>
                            </div>
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Role</p>
                                <select
                                    class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                    wire:model="role"
                                    required>
                                    <option value="" disabled selected>Select a role...</option>
                                    <option value="admin">Admin</option>
                                    <option value="approver">Approver</option>
                                    <option value="seller">Seller</option>
                                </select>
                                <div class="text-sm text-red-500">@error('sub_categories') {{ $message }} @enderror</div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Password</p>
                                        <input
                                            class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                            type="password"
                                            wire:model="password"
                                            required>
                                        <div class="text-sm text-red-500">@error('password') {{ $message }} @enderror</div>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Password Confirmation</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="password" required wire:model="password_confirmation">
                                </div>
                            </div>
                        </div>
                        {{-- Loading Animation --}}
                        <div class="w-full text-center" wire:loading>
                            <div class="flex justify-center items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                </svg>
                                <span class="text-md font-medium text-slate-600">Saving post...</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                    @click="add_user_modal=false; $wire.call('resetData', ['first_name', 'last_name', 'email', 'home_address', 'contact_number', 'role', 'password', 'password_confirmation'])">
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

