<?php
use App\Models\ContactForm;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;



new class extends Component 
{
    public $name;
    public $email;
    public $message;
    public $submissionSuccess = false;
    public $submissionFailed = false;
    public $errorMessage = '';
    public $successMessage = 'Your form has been successfully submitted. Thank you!';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ];

    public function submitForm()
    {
        $this->validate();

        $inputs = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,

        ];

        try {
            // Save to database
            $contact_form = ContactForm::create($inputs);

            // Send email notification
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactFormSubmitted($inputs));

            $this->submissionSuccess = true;
            $this->submissionFailed = false;
            $this->reset(['name', 'email', 'message']);
        } catch (\Exception $e) {
            $this->submissionSuccess = false;
            $this->submissionFailed = true;
            $this->errorMessage = 'Oops! It looks like there was an issue with your submission. Please try again.';
        }
    }
    
};
?>

<div class="min-h-44 max-w-2xl mx-auto bg-white border shadow-md rounded-lg">
    <form wire:submit.prevent="submitForm">
        <div class="flex flex-col gap-10 p-5 sm:p-10">
            <p class="text-slate-700 text-lg font-bold">Email us at help@domain.com</p>
            <div class="flex flex-wrap gap-5">
                <div class="flex-1 min-w-64 relative z-0">
                    <input type="text" name="name" wire:model="name"  class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required/>
                    <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 ">Your name</label>
                </div>
                <div class="flex-1 min-w-64 relative z-0">
                    <input type="text" name="email" wire:model="email" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required/>
                    <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Your Email</label>
                </div>
            </div>
            <div class="relative z-0">
                <textarea name="message" rows="5" wire:model="message"  class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0" placeholder=" " required></textarea>
                <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Your message</label>
            </div>
            <div class="flex">
                <button class="text-white bg-[#1F4B55] text-sm px-6 py-3 rounded-lg shadow-md hover:bg-[#245D69] transition-colors duration-300 cursor-pointer">Submit</button>
            </div>
            @if($submissionSuccess)
                <div class="text-green-500 mt-3 text-end" wire:loading.remove>
                    {{ $successMessage }}
                </div>
            @endif
            @if($submissionFailed)
                <div class="text-red-500 mt-3 text-end" wire:loading.remove>
                    {{ $errorMessage }}
                </div>
            @endif
        </div>
    </form>
</div>
