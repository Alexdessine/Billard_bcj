<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Gestion classement blackball</h2>
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="text-center mt-4">
                <a href="{{ route('tournois.show') }}" id="toggleLink" class="btn btn-danger m-0 mb-3 text-center"><i class="fa-solid fa-arrow-rotate-left"></i> Mettre à jour les liens CueScore</a>
                <a href="{{ route('tournois.update') }}" class="btn btn-warning m-0 mb-3 text-center"><i class="fa-solid fa-ranking-star"></i> Mettre à jour le classement</a>
            </div>
        </div>
    </div>
</body>
