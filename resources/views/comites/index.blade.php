<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
                <h2>Membres du comité</h2>
            </div>
                    <!-- Section pour le message de succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="three">
                <div class="boutons">
                    <a href="{{ route('comites.create') }}" class="btn btn-info"><i class="fa-solid fa-circle-plus"></i> Ajouter un membre</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom - Prénom</th>
                            <th scope="col">Fonction</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Image</th>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <th scope="col" colspan="3">Options</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comites as $comite)
                        <tr>
                            <td>{{ $comite->nom }} {{ $comite->prenom }}</td>
                            <td>{{ $comite->fonction }}</td>
                            <td>{{ $comite->telephone }}</td>
                            <td>{{ $comite->email }}</td>
                            <td><img src="{{ asset('storage/' . $comite->image) }}" alt="" width="320px"></td>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <td>
                                <a href="{{ route('comites.show', ['id' => $comite->id])}}"><i class="fa-solid fa-eye mr-2"></i></a>
                                <a href="{{ route('comites.edit', ['id' => $comite->id]) }}"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('comites.destroy', ['id' => $comite->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
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
                {{ $comites->links() }}
            </div>
            </div>
        </div>
    </body>


<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer ce membre?");
    }
</script>