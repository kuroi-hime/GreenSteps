<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white']) }}>
    {{ $slot }}
</button>