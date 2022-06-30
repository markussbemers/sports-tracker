<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            KOMNADA: {{$team->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'store']) }}">
                @csrf
                <label for="palyers">Pievienot spēlētāju</label>
                                         
                </form> 
            </div>
            <br><br><br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ action([App\Http\Controllers\TeamController::class, 'store']) }}">
                @csrf
                <label for="palyers">Pievienot treniņu</label>
                                         
                </form> 
            </div>
                
        </div>
    </div>
</x-app-layout>
<script>
</script>