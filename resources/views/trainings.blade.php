<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Upcoming practice sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($trainings as $training)
                    <div class="p-6 bg-white border-b border-gray-200 training-box">
                        <div class="team-name">{{ $training->name }}</div>
                        <div class="date-and-time">{{ $training->start_date_and_time }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
