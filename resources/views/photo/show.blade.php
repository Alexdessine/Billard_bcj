<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2><img src="{{ asset('storage/' . $gallerie->images) }}" width="360px" height="auto" alt=""></h2>
        </div>
        <div class="three">
            <div class="mt-4 text-center">
                <div class="boutons">
                    <a href="{{ route('photos') }}" class="btn btn-success"><i class="fa-solid fa-backward-step"></i> Retour</a>
                    <form action="" class="mt-4" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{ $gallerie->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
