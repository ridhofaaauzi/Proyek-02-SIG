@extends('layouts.app')

@section('title', 'Peta Tingkat Kelahiran Kota ' . $city_name)

@push('custom.styles')
    @include('pages.includes.styles')
@endpush

@section('content')
    @include('layouts.nav')

    <main class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 my-6 px-4 sm:px-6 lg:px-8">
        @include('components.modal')

        <div class="col-span-12 lg:col-span-8 relative">
            <div id="map-skeleton" class="w-full rounded shadow bg-gray-300 animate-pulse"></div>
            <div id="map" class="w-full rounded shadow hidden"></div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white p-6 rounded shadow">
                <div class="w-fit px-4 py-1 bg-green-100 rounded">
                    <h2 class="font-medium text-green-600">Terkonfirmasi</h2>
                </div>
                <p class="mt-2 text-gray-600 text-sm">{{ $birth_rate->created_at->format('d M Y, H:i:s') }}</p>
                <h3 class="mt-4 text-xl text-gray-800 font-bold">{{ $birth_rate->district->name }}</h3>
                <div class="mt-4">
                    <div class="bg-slate-100 flex flex-col py-2 rounded-md">
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-users class="w-5 h-5 text-red-500" />
                                <p class="font-medium text-start text-slate-500">Populasi:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">
                                {{ $district_data->population }}</p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-target class="w-5 h-5 text-green-500" />
                                <p class="font-medium text-start text-slate-500">Area:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">
                                {{ $district_data->area }} Km²</p>
                        </div>
                        <div class="flex justify-between space-x-2 px-4 p-2">
                            <div class="flex space-x-2 items-center">
                                <x-lucide-baby class="w-5 h-5 text-blue-500" />
                                <p class="font-medium text-start text-slate-500">Total Kelahiran:</p>
                            </div>
                            <p class="font-bold text-end text-slate-700">{{ $birth_rate->total }}</p>
                        </div>
                    </div>
                </div>
                <button id="openModal" class="mt-6 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Lihat
                    Detail</button>
            </div>
        </div>

        @include('components.spinner')
        @include('components.legend')
    </main>
@endsection

@push('custom-scripts')
    @include('includes.leaflet')
    @include('pages.includes.map')
    @include('pages.includes.modal')
@endpush
