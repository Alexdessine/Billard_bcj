<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2>tournoi national :&nbsp <strong>{{ $national->titre }}</strong></h2>
            
        </div>
        <div class="three">
            <div class="m-auto text-center pt-4">
                <p><strong>Date : </strong>Du {{ date('d-m-Y', strtotime($national->date_debut)) }} au {{ date('d-m-Y', strtotime($national->date_fin)) }}</p>
                <p><strong>Lieu : </strong>{{ $national->lieu }}</p>
                <p><strong>Club organisateur : </strong>{{ $national->club }}</p>
            </div>
            <div class="boutons">
                <a href="{{ route('national') }}" class="btn btn-success"><i class="fa-solid fa-backward-step"></i> Retour</a>
                <form action="{{ route('national.destroy', ['id' => $national->id]) }}" class="mt-4" method="POST" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer ce tournoi?");
    }
</script>