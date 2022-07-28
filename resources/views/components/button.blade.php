<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-secondary-bg border border-transparent rounded-md font-semibold text-xs text-primary-bg uppercase tracking-widest hover:bg-primary-fg active:bg-secondary-fg focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
