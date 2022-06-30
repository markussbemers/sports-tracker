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
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus/>

                        <x-label class="mt-3" for="sports_types_id" :value="__('Organizācijas sporta veids')" />
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <label for="sports_type">Choose a sports type:</label>
                            <select id="sports_type" name="sports_type_id">
                            @foreach ($sportsTypes as $sportsType)
                                <option value={{$sportsType->id}}>{{$sportsType->type}}</option>
                            @endforeach
                            </select>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Create
                            </x-button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

</script>
