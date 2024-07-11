<?php

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;

new class extends Component {
    public $user;
    public $first_name = '';
    public $last_name = '';
    public $contact_number = '';
    public $home_address = '';
    public $email = '';
    public $role = '';
    public $initial_data = [];
    #[Validate('confirmed')]
    public $password = '';
    public $password_confirmation = '';
    public $add_user_modal = false;

    public function mount($user){
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->contact_number = $user->contact_number;
        $this->home_address = $user->home_address;
        $this->role = $user->role;
        
        $this->initial_data = [
            'first_name' => $this->first_name, 
            'last_name' => $this->last_name, 
            'email' => $this->email, 
            'contact_number' => $this->contact_number, 
            'home_address' => $this->home_address, 
            'role' => $this->role
        ];
    }

    public function saveUser()
    {
        $this->validate();

        $data = [
            'first_name' => trim($this->first_name),
            'last_name' => trim($this->last_name),
            'contact_number' => trim($this->contact_number),
            'home_address' => $this->home_address,
            'email' => $this->email,
            'role' => $this->role,
            'updated_by' => auth()->user()->id
        ];

        $this->user->update($data);

        $this->initial_data = $data;

        $this->add_user_modal = false;
        $this->dispatch('alert-success');
    }

    public function loadInitialData()
    {
        $this->first_name = $this->initial_data['first_name'];
        $this->last_name = $this->initial_data['last_name'];
        $this->contact_number = $this->initial_data['contact_number'];
        $this->home_address = $this->initial_data['home_address'];
        $this->email = $this->initial_data['email'];
        $this->role = $this->initial_data['role'];
    }

    public function resetData($data)
    {
        $this->reset($data);
    }

    public function rules()
    {
        return [
            'email' => [
                Rule::unique('users', 'email')->ignore($this->user), 
            ],
        ];
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
        EDIT
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="add_user_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="add_user_modal=false; $wire.loadInitialData()">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="saveUser">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Edit User</p>
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
                                            wire:model="password">
                                        <div class="text-sm text-red-500">@error('password') {{ $message }} @enderror</div>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Password Confirmation</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="password" wire:model="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                    @click="add_user_modal=false; $wire.loadInitialData()">
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

