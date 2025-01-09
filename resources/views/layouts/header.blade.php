<header>
    <div class="bg-blue-700 px-4 py-2">
        <div
            class="text-gray-200 text-sm text-center mx-auto max-w-7xl flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 justify-between items-center">
            <p id="current-date" class="sm:text-start"></p>
            <p class="sm:text-end">STANDAR WAKTU INDONESIA | <span id="current-time" class="text-green-500"></span>
            </p>
        </div>
    </div>

    <div class="bg-blue-600 p-4">
        <div class="text-white mx-auto max-w-7xl flex justify-between items-center">
            @if (!request()->routeIs('home'))
                <a class="text-lg font-bold" href="{{ route('home') }}">PETA TINGKAT KELAHIRAN KOTA
                    {{ strtoupper($city_name) }}</a>
            @else
                <h1 class="text-sm sm:text-base md:text-lg font-bold">PETA TINGKAT KELAHIRAN KOTA
                    {{ strtoupper($city_name) }}</h1>
            @endif

            <nav class="hidden md:flex space-x-4">
                <a class="flex items-center px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700"
                    href="{{ route('filament.admin.pages.dashboard') }}">
                    <x-lucide-user class="w-5 h-5 text-white" />
                    <span>Admin</span>
                </a>
            </nav>

            <button id="mobileMenuButton"
                class="md:hidden flex items-center space-x-2 px-4 py-2 text-white rounded hover:bg-blue-700">
                <x-lucide-menu class="w-5 h-5 text-white" />
                <span>Menu</span>
            </button>
        </div>

        <nav id="mobileMenu" class="hidden bg-blue-500 p-2 rounded mt-2 md:hidden">
            <a class="block px-4 py-2 text-white rounded hover:bg-blue-700"
                href="{{ route('filament.admin.pages.dashboard') }}">
                <x-lucide-user class="inline w-5 h-5 text-white" /> Admin
            </a>
        </nav>
    </div>
</header>
