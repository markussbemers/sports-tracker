<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.My Organizations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($organizations as $organization)
                    <div style="cursor: pointer" class="p-6 bg-white border-b border-gray-200" onclick='showTeams({{ $organization->id }})'>
                        <div>{{ $organization->name }}</div>
                        <form method="POST" action="{{ action([App\Http\Controllers\OrganizationController::class, 'destroy'], $organization->id)}}">
                            @csrf @method('DELETE')
                            <x-button type="submit" value="delete">{{ __('messages.Delete') }}</x-button>
                        </form>
                    </div>
                @endforeach   
            </div>
        </div>
    </div>
</x-app-layout>
<script>
		function showTeams(typeId) {
			window.location.href = "/teams/organizations/" + typeId;
		}
</script>