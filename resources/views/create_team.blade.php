<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Create a team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'store']) }}">
                @csrf
                <label for="organization">{{ __('messages.Choose an organization') }}:</label>
                        <select id="organization" name="organization_id">
                        @foreach ($organizations as $organization)
                            <option value={{$organization->id}}>{{$organization->name}}</option>
                        @endforeach
                        </select>
                    </div>
                
                    <div>
                        <x-label for="name" :value="__('messages.Team Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus/>
                    </div>
                    <x-button class="ml-3 mt-3">
                        {{ __('messages.Create a team') }}
                    </x-button>
                </form>        
            </div>
                
        </div>
    </div>
</x-app-layout>
<script>
</script>