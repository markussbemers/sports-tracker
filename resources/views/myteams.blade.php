﻿<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Organization Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($teams as $team)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="team-name">{{ $team->name }}
                        <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'destroyTeam'], $team->id) }}">
                            @csrf
                                <x-button type="submit" value="delete">{{ __('messages.Delete') }}</x-button>
                        </form>
                        </div>
                    </div>
                @endforeach    
            </div>
        </div>
    </div>
</x-app-layout>