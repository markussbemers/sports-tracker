<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Default attendence in teams I play
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($teams as $team)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="team-name">KOMANDA: {{ $team->name }}</div>
                        <div class="team-status">NOKLUSĒTĀ VĒRTĪBA TRENIŅU APMEKLĒŠANAI:
                                    @if ($team->is_default_attending == 1)
                                        Būšu
                                    @else
                                        Nebūšu
                                    @endif
                        </div>
                        <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'willAlwaysAttend'], ['team_id' => $team->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">turpmāk būšu</x-button>
                                </form>

                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'willNeverAttend'], ['team_id' => $team->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">turpmāk nebūšu</x-button>
                                </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>