<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alaska Payment Success</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <main class="grid min-h-full px-6 py-24 bg-white place-items-center sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-green-600">Payment Successful</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Thank You!</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">Your payment has been processed successfully. You can now return to your featured listing options.</p>
            <div class="flex items-center justify-center mt-10 gap-x-6">
                <a href="{{ route('seller-advertisement') }}" 
                class="rounded-md bg-[#2171a7] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Go Back to Featured Listing
                </a>
                <a href="{{ route('advertise-with-us') }}" class="text-sm font-semibold text-gray-900 hover:opacity-70">Contact support <span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </main>


    @livewireScripts
    <script>
    </script>
</body>
</html>