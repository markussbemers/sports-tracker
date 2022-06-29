<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gaidāmie treniņi >') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 training-box">
                    <div class="team-sport">Regbijs</div>
                    <div class="team-name">RK Baldone</div>
                    <div class="date-and-time">21.07 19:00</div>
                    <div class="status"> būšu</div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    Jūs tikāt iekšā mājaslapā!</br>
                    Šeit gan jau kko būs vēl jāieliek :D
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
