<footer class="p-4 border-t-2 border-blue-500 bg-zinc-900">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Landing Page" class="w-32">
            </a>
        </div>
        <div>
            <span class="font-serif text-sm text-white">{{ now()->year }} Proweb. All Rights Reserved.</span>
        </div>
    </div>
</footer>
