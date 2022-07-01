<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('messages.Playing teams') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($teams as $team)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="team-name">{{ $team->name }}</div>
                        <div class="team-status">VIENMĒR APMEKLĒŠU TRENIŅUS:
                                    @if ($team->is_default_attending == 1)
                                        JĀ
                                    @else
                                        NĒ
                                    @endif
                        </div>
                        <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'willAlwaysAttend'], ['team_id' => $teams->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">būšu vienmēr</x-button>
                                </form>

                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'willNeverAttend'], ['team_id' => $teams->id]) }}">
                                    @csrf
                                    <x-button class="ml-3 mt-3">nebūšu turpmāk</x-button>
                                </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>