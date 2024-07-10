<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <!-- Success Alert -->
    <div class="hidden items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
        role="alert" id="alert-success">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2 fill-current text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M9 21H5V11H2.5L12 3.25L21.5 11H19V21H15V13H9V21Z"/>
            </svg>
            <div>
                <p class="font-bold">Success!</p>
                <p>Your operation was successful.</p>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="svg-x size-6 cursor-pointer hover:opacity-70">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>

    <!-- Info Alert -->
    <div class="hidden items-center justify-between bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4"
        role="alert" id="info-message">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM11 17H13V11H11V17ZM11 9H13V7H11V9Z"/>
            </svg>
            <div>
                <p class="font-bold">Info!</p>
                <p>This is an informational message.</p>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="svg-x size-6 cursor-pointer hover:opacity-70">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>

    <!-- Error Alert -->
    <div class="hidden items-center justify-between bg-red-100 border-l-4 border-red-500 text-red-700 p-4"
        role="alert" id="error-message">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M11 15H13V17H11V15ZM11 7H13V13H11V7ZM12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2Z"/>
            </svg>
            <div>
                <p class="font-bold">Error!</p>
                <p>There was an error with your operation.</p>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="svg-x size-6 cursor-pointer hover:opacity-70">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>

    <!-- Livewire Event Listeners -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('alert-success', () => {
                document.getElementById('alert-success').classList.remove('hidden');
                document.getElementById('alert-success').classList.add('flex');
                setTimeout(() => {
                    document.getElementById('alert-success').classList.remove('flex');
                    document.getElementById('alert-success').classList.add('hidden');
                }, 10000);
            });

            Livewire.on('alert-info', () => {
                document.getElementById('info-message').classList.remove('hidden');
                document.getElementById('info-message').classList.add('flex');
                setTimeout(() => {
                    document.getElementById('info-message').classList.remove('flex');
                    document.getElementById('info-message').classList.add('hidden');
                }, 10000);
            });

            Livewire.on('alert-error', () => {
                document.getElementById('error-message').classList.remove('hidden');
                document.getElementById('error-message').classList.add('flex');
                setTimeout(() => {
                    document.getElementById('error-message').classList.remove('flex');
                    document.getElementById('error-message').classList.add('hidden');
                }, 10000);
            });

            // Close button event listeners
            document.querySelectorAll('.svg-x').forEach(button => {
                button.addEventListener('click', () => {
                    button.closest('.items-center').classList.remove('flex');
                    button.closest('.items-center').classList.add('hidden');
                });
            });
        });
    </script>
</div>

