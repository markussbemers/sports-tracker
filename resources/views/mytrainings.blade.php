<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Upcoming practice sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($trainings) > 0)
                    @foreach ($trainings as $training)
                        <div class="p-6 bg-white border-b border-gray-200 training-box">
                            <div class="team-name">Komanda: {{ $training->name }}</div>
                            <div class="date-and-time">Datums: {{ $training->start_date_and_time }}</div>
                            <div class="status">Status: 
                                                @if (count($willAttend) > 0)
                                                        @foreach ($willAttend as $attend)
                                                            @if ($training->id == $attend->training_id)
                                                                Būšu
                                                                @break
                                                            @endif
                                                            @if($loop->last)
                                                                Nebūšu
                                                            @endif
                                                        @endforeach
                                                    @else
                                                    Nebūšu
                                                @endif
                            </div>

                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'willAttend'], ['training_id' => $training->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">būšu</x-button>
                                </form>

                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'wontAttend'], ['training_id' => $training->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">nebūšu</x-button>
                                </form>
                        </div>
                    @endforeach
                @else
                    I don't have any training!
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
