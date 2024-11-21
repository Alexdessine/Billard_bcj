<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Gestion participants tournois blackball régionaux</h2>
        </div>
        <div class="three">
            {{-- Afficher le message de succès s'il existe --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <p class="text-center text-green-800 font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="text-center mt-4">
                {{-- Lien pour mettre à jour les liens CueScore --}}
                <a href="{{ route('participants.show') }}" id="toggleLink" class="btn btn-danger m-0 mb-3 text-center">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Mettre à jour les liens CueScore
                </a>

                @if($fileExists)
                    {{-- Si le fichier existe, afficher le lien de téléchargement --}}
                    <a href="{{ route('participants.download') }}" class="btn btn-success m-0 mb-3 text-center">
                        <i class="fa-solid fa-file-xls"></i> Télécharger Excel
                    </a>
                @else
                    {{-- Si le fichier n'existe pas, afficher le bouton pour générer le fichier Excel --}}
                    <a href="{{ route('participants.generate') }}" class="btn btn-warning m-0 mb-3 text-center">
                        <i class="fa-solid fa-file-xls"></i> Générer le fichier Excel
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
