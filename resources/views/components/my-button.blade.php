<button {{ $attributes->merge(['type' => 'submit']) }}>
    {{ $slot }}
</button>
<!-- , 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest dark:hover:bg-white dark:focus:bg-white dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150' -->