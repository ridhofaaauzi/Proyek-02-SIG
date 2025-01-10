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
            <a class="text-lg font-bold" href="{{ !request()->routeIs('pages.home') ? route('pages.home') : null }}">PETA
                TINGKAT KELAHIRAN KOTA
                {{ strtoupper($city_name) }}</a>

            <nav class="hidden md:flex space-x-4">
                <a class="relative flex items-center px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700 group"
                    href="{{ route('pages.team') }}">
                    <x-lucide-users class="w-5 h-5 text-white" />
                    <span>Anggota Tim</span>
                    @if (request()->routeIs('pages.home'))
                        <div id="desktopTooltip"
                            class="absolute !m-0 top-full left-1/2 transform -translate-x-1/2 translate-y-2 bg-red-500 text-white text-xs font-medium px-3 py-1 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Lihat Tim Kami
                        </div>
                    @endif
                </a>
                <a class="flex items-center px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700"
                    href="{{ route('filament.admin.pages.dashboard') }}">
                    <x-lucide-user class="w-5 h-5 text-white" />
                    <span>Admin</span>
                </a>
            </nav>

            <button id="mobileMenuButton"
                class="relative md:hidden flex items-center space-x-2 px-4 py-2 text-white rounded hover:bg-blue-700">
                <x-lucide-menu class="w-5 h-5 text-white" />
                <span>Menu</span>
                @if (request()->routeIs('pages.home'))
                    <div id="mobileTooltip"
                        class="md:hidden absolute !m-0 top-full left-1/2 transform -translate-x-1/2 translate-y-2 bg-red-500 text-white text-xs font-medium px-3 py-1 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Lihat Tim Kami
                    </div>
                @endif
            </button>
        </div>

        <nav id="mobileMenu" class="hidden bg-blue-500 p-2 rounded mt-2 md:hidden">
            <a class="relative block px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700"
                href="{{ route('pages.team') }}">
                <x-lucide-users class="inline w-5 h-5 text-white" />
                <span>Anggota Tim</span>
                @if (request()->routeIs('pages.home'))
                    <div id="mobileMenuTooltip"
                        class="md:hidden absolute !m-0 top-1/2 right-0 transform -translate-y-1/2 -translate-x-2 bg-red-500 text-white text-xs font-medium px-3 py-1 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Lihat Tim Kami
                    </div>
                @endif
            </a>
            <a class="block px-4 py-2 space-x-2 text-white rounded hover:bg-blue-700"
                href="{{ route('filament.admin.pages.dashboard') }}">
                <x-lucide-user class="inline w-5 h-5 text-white" />
                <span>Admin</span>
            </a>
        </nav>
    </div>
</header>
