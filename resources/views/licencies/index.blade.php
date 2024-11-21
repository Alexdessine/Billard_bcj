<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Liste des licenciés ({{ $totalLicencies }})</h2>
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="boutons">
                <a href="{{ route('licencies.update') }}" class="btn btn-info"><i class="fa-solid fa-arrow-rotate-left"></i> Mettre à jour les licenciés</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Licence</th>
                        <th>Nom - Prénom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licencies as $licencie)
                        <tr>
                            <td>{{ $licencie->licence }}</td>
                            <td>{{ $licencie->nom }} {{ $licencie->prenom }}</td>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <td>
                                <a href="{{ $licencie->url }}" target="_blank"><i class="fa-solid fa-eye mr-2"></i></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $licencies->links() }}
            </div>
        </div>
    </div>
</body>

<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?");
    }
</script>