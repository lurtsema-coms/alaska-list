<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent bg-search-gradient font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#245D69]  focus:outline-none focus:ring-2 focus:ring-[#1F4B55] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
