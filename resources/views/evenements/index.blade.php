<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
                <h2>Evènements Facebook</h2>
            </div>
                    <!-- Section pour le message de succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="three">
                <div class="boutons">
                    <a href="{{ route('evenements.create') }}" class="btn btn-info"><i class="fa-solid fa-circle-plus"></i> Ajouter un évènement</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Lien Facebook</th>
                            <th scope="col">Image</th>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <th scope="col" colspan="3">Options</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evenements as $evenement)
                        <tr>
                            <td>{{ $evenement->facebook }}</td>
                            <td><img src="{{ asset('storage/' . $evenement->image) }}" alt="" width="320px"></td>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <td>
                                <a href="{{ route('evenements.show', ['id' => $evenement->id])}}"><i class="fa-solid fa-eye mr-2"></i></a>
                                <form action="{{ route('evenements.destroy', ['id' => $evenement->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="mt-4">
                {{ $evenements->links() }}
            </div>
            </div>
        </div>
    </body>


<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet évènement?");
    }
</script>