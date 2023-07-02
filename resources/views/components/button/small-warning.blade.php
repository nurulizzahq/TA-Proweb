@isset($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900']) }}>{{ $slot }}</a>
@else
    <button
        {{ $attributes->merge(['type' => 'button', 'class' => 'px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900']) }}>
        {{ $slot }}
    </button>
    @endif
