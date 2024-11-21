<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Liste des utilisateurs</h2>
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="boutons">
                <a href="{{ route('utilisateurs.create') }}" class="btn btn-info" ><i class="fa-solid fa-circle-plus"></i> Ajouter un utilisateur</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                {!! $user->regen 
                                    ? '<i class="fa-solid fa-circle-info" style="color: #FFD43B;" title="Modification de mot de passe demandée"></i>' 
                                    : '' 
                                !!} 
                                {{ $user->email }}
                            </td>
                            <td>{{ $user->role->name ?? 'Aucun rôle' }}</td>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <td>
                                <a href="{{ route('utilisateurs.show', ['id' => $user->id]) }}" ><i class="fa-solid fa-eye mr-2"></i></a>
                                <form action="{{ route('utilisateurs.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
</body>

<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?");
    }
</script>