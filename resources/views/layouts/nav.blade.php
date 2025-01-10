<nav class="bg-white border-b px-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-2">
        <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap gap-2 md:gap-4">
            @foreach ($years as $year)
                <form action="{{ route('pages.home') }}" method="GET" class="inline">
                    <input type="hidden" name="year" value="{{ $year }}">
                    <button type="submit"
                        class="w-full md:w-fit flex justify-between md:justify-normal items-center px-4 py-2 gap-2 rounded
                           {{ $year == $selected_year ? 'bg-blue-500 text-white hover:bg-blue-600' : 'bg-white-500 border text-gray-600 hover:text-white hover:bg-blue-500 group' }}">
                        <x-lucide-calendar-days
                            class="w-5 h-5 order-3 md:order-1
                               {{ $year == $selected_year ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" />
                        <span class="order-2">{{ $year }}</span>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</nav>
