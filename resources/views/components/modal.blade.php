<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[10000]">
    <div class="bg-white w-11/12 md:w-1/2 rounded shadow-lg p-6">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-lg font-bold">Detail Kecamatan</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <x-lucide-x class="w-5 h-5" />
            </button>
        </div>
        <div class="mt-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-6 bg-slate-100 flex flex-col py-2 rounded-md">
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-house class="w-5 h-5 text-orange-500" />
                        <p class="font-medium text-start text-slate-500">Nama Kecamatan:</p>
                    </div>
                    <p id="modalDistrictName" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-calendar-days class="w-5 h-5 text-red-500" />
                        <p class="font-medium text-start text-slate-500">Tahun Data Kecamatan:</p>
                    </div>
                    <p id="modalDistrictDataYear" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-move-horizontal class="w-5 h-5 text-green-500" />
                        <p class="font-medium text-start text-slate-500">Latitude:</p>
                    </div>
                    <p id="modalDistrictLatitude" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-move-vertical class="w-5 h-5 text-blue-500" />
                        <p class="font-medium text-start text-slate-500">Longitude:</p>
                    </div>
                    <p id="modalDistrictLongitude" class="font-bold text-end text-slate-700"></p>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 bg-slate-100 flex flex-col py-2 rounded-md">
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-calendar-days class="w-5 h-5 text-orange-500" />
                        <p class="font-medium text-start text-slate-500">Tahun Kelahiran:</p>
                    </div>
                    <p id="modalBirthYear" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-users class="w-5 h-5 text-red-500" />
                        <p class="font-medium text-start text-slate-500">Populasi:</p>
                    </div>
                    <p id="modalPopulation" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-target class="w-5 h-5 text-green-500" />
                        <p class="font-medium text-start text-slate-500">Area:</p>
                    </div>
                    <p id="modalArea" class="font-bold text-end text-slate-700"></p>
                </div>
                <div class="flex justify-between space-x-2 px-4 p-2">
                    <div class="flex space-x-2 items-center">
                        <x-lucide-baby class="w-5 h-5 text-blue-500" />
                        <p class="font-medium text-start text-slate-500">Total Kelahiran:</p>
                    </div>
                    <p id="modalBirthRate" class="font-bold text-end text-slate-700"></p>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button id="closeModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tutup</button>
        </div>
    </div>
</div>
