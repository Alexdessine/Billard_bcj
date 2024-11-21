<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2><img src="{{ asset('storage/' . $evenement->image) }}" width="360px" height="auto" alt=""></h2>
        </div>
        <div class="three">
            <div class="mt-4 text-center">
                <a class="text-red-600" href="{{ $evenement->facebook }}" target="_blank">Lien Facebook</a>
                            <div class="boutons">
                <a href="/evenements" class="btn btn-success"><i class="fa-solid fa-backward-step"></i> Retour</a>
                <form action="" class="mt-4" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{ $evenement->id }}">
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
