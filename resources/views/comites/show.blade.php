<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2><img src="{{ asset('storage/' . $comite->image) }}" width="360px" height="auto" alt=""></h2>
        </div>
        <div class="three">
            <div class="mt-4 text-center">
                <p><strong>Nom : </strong>{{ $comite->nom }}</p>
                <p><strong>Prénom : </strong>{{ $comite->prenom }}</p>
                <p><strong>Fonction : </strong>{{ $comite->fonction }}</p>
                <p><strong>Téléphone : </strong>{{ $comite->telephone }}</p>
                <p><strong>Email : </strong>{{ $comite->email }}</p>
                <div class="boutons">
                    <a href="{{ route('comites') }}" class="btn btn-success"><i class="fa-solid fa-backward-step"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
</body>
