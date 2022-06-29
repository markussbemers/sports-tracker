<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izveidot organizāciju') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{action([App\Http\Controllers\OrganizationController::class, 'store']) }}">
                        @csrf
                        <x-label for="name" :value="__('Organizācijas nosaukums')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="organization_name" required autofocus/>

                        <x-label class="mt-3" for="sports_types_id" :value="__('Organizācijas sporta veids')" />
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            @foreach ($sportsTypes as $sportsType)
                                <x-label class="ml-3" for="sports_types_id"> {{ $sportsType->type }}</x-label>
                                <input class="ml-3" type="radio" id="sports_types_id" name="{{$sportsType->id}}">
                            @endforeach
                        </div>
                        <x-button class="ml-3 mt-3">
                            {{ __('Create Organization') }}
                        </x-button>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>