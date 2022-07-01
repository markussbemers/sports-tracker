<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('messages.Team') }}: "{{$team->name}}". {{ __('messages.You are') }}: {{$coach}}{{$leader}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
             {{ __('messages.Change coach') }}:
                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'changeCoach']) }}">
                                @csrf
                                
                                <div>
                                    <x-label for="team_id" :value="__('messages.Team_id')" />
                                    <input id="team_id" type="text" name="team_id" readonly value={{$team->id}}></input>
                                </div>

                                <div>
                                    <x-label for="current_coach" :value="__('messages.Current Coach')" />
                                    <input id="current_coach" type="text" name="current_coach" readonly value={{$coaches->name}}></input>
                                </div>

                                <div>
                                    <x-label for="coach_name" :value="__('messages.New Coach Name')" />
                                    <x-input id="coach_name" class="block mt-1 w-full" type="text" name="coach_name" required autofocus/>
                                </div>
                                <x-button class="ml-3 mt-3">
                                        {{ __('messages.Change') }}
                                </x-button>
                                {{$message2}}
                        </form>

            </div>

            <br><br><br>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'addTraining']) }}">
                @csrf
                <label for="players">{{ __('messages.Add training session') }}</label>
                <br><br>           
                <div>
                    <x-label for="date_and_time" :value="__('messages.Player name')" />
                    <x-input id="date_and_time" class="block mt-1 w-full" type="datetime-local" name="date_and_time" required autofocus/>
                </div>

                <div>
                    <x-label for="team_id" :value="__('messages.Team_id')" />
                    <input id="team_id" type="text" name="team_id" readonly value={{$team->id}}></input>
                </div>

                <x-button class="ml-3 mt-3">
                        {{ __('messages.Add') }}
                </x-button>
                </form>
            </div>

            <br><br><br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            {{ __('messages.Practice sessions') }}:
                    <ol>
                        @foreach ($trainings as $training)
                            <li>
                                {{$training->start_date_and_time}}
                            </li>
                        @endforeach
                    </ol>
            </div>
            <br><br><br>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'addPlayer']) }}">
                @csrf
                <label for="players">{{ __('messages.Add player') }}</label>
                <br><br>           
                <div>
                    <x-label for="player_name" :value="__('messages.Player name')" />
                    <x-input id="player_name" class="block mt-1 w-full" type="text" name="player_name" required autofocus/>
                </div>

                <div>
                    <x-label for="team_id" :value="__('messages.Team_id')" />
                    <input id="team_id" type="text" name="team_id" readonly value={{$team->id}}></input>
                </div>

                <x-button class="ml-3 mt-3">
                        {{ __('messages.Add') }}
                </x-button>
                {{$message}}

                </form>
            </div>

            <br><br><br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            {{ __('messages.Players') }}:
                    <ul>
                        @foreach ($team_players as $team_player)
                            <li>
                                <form method="POST" action="{{action([App\Http\Controllers\TeamController::class, 'destroyPlayer'], ['id' => $team_player->id, 'team_id' => $team->id]) }}">
                                @csrf
                                    {{$team_player->name}}
                                <x-button class="ml-3 mt-3">
                                        {{ __('messages.Delete') }}
                                </x-button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
            </div>
                
        </div>
    </div>
</x-app-layout>
<script>
</script>