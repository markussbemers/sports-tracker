<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Sports types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($sportsTypes as $sportsType)
                    <div style="cursor: pointer" class="p-6 bg-white border-b border-gray-200" onclick='showTeams({{ $sportsType->id }})'> <!-- cant pass sportType->type -->
                        <div class="sports-type">{{ $sportsType->type }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<script>
		function showTeams(typeId) {
			window.location.href = "/sports-types/" + typeId;
		}
</script>