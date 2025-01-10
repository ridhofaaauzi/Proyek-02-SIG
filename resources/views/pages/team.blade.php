@extends('layouts.app')

@section('title', 'Anggota Tim')

@push('custom.styles')
    @include('pages.includes.styles')
@endpush

@section('content')
    <main class="relative max-w-7xl mx-auto lg:my-6 lg:px-8">
        <div class="text-center py-8 sm:mt-10 sm:mb-16 px-4 sm:p-0">
            <h1 class="text-2xl sm:text-3xl font-bold sm:leading-9 text-gray-800">Peta Kelahiran Kota Depok: Data, Tren, dan
                Masa Depan</h1>
            <p class="text-base font-normal text-gray-600 mt-2">
                Menyediakan data kelahiran yang akurat dan interaktif untuk membantu memahami pertumbuhan populasi dan
                perencanaan wilayah yang lebih baik.
            </p>
        </div>
        <div class="bg-inherit sm:bg-white py-6 sm:p-6 sm:rounded sm:shadow">
            <h1 class="text-2xl text-gray-800 text-center sm:text-start font-bold mb-4 px-4 sm:p-0">Anggota Tim</h1>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-[320px] sm:max-w-none mx-auto">
                @foreach ($team_members as $member)
                    <div
                        class="group max-[320px]:rounded-none min-[320px]:rounded sm:shadow-md overflow-hidden sm:hover:shadow-lg duration-100 ease-linear">
                        <div class="relative w-full h-72 overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-300 animate-pulse skeleton"></div>
                            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}"
                                class="w-full h-full object-cover user-select-none transition-transform duration-300 ease-in-out group-hover:scale-105 hidden skeleton-loaded"
                                draggable="false" oncontextmenu="return false;"
                                onload="this.classList.remove('hidden'); this.previousElementSibling.remove();">
                        </div>
                        <div class="w-full">
                            <div class="bg-white flex flex-col space-y-2 px-3 py-2 rounded-sm border border-1 border-white">
                                <h2 class="text-lg font-bold text-gray-800">{{ $member['name'] }}</h2>
                                <p class="text-xs font-medium text-gray-600">{{ $member['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
