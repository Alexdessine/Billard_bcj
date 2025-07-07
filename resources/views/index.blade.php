        {{-- <section>
        <img src="{{ asset('img/ban_fb.jpg')}}" alt="">
    </section> --}}
<x-layout>
        <section>
        <img src="{{ asset('uploads/' . $banniere->banniere) }}" alt="">
    </section>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>

    <section class="accueil">
        {{-- Elément accueil start --}}
        <div class="home">
            <x-title>Accueil</x-title>
            <x-cadre>
                @if($indexPost)
                @php
                    $allowedTags = '<p><br><b><i><strong><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><span>';
                    $cleanContent = strip_tags($indexPost->content, $allowedTags);
                @endphp
                    <p>{!! nl2br($cleanContent) !!}</p>
                @endif
            </x-cadre>
        </div>
        {{-- Elément accueil end --}}
        {{-- Elément post start --}}
        {{-- Si un post est mis à la une dans l'administration, 
            celui ci s'affiche, sinon on affiche les posts facebook 
        ou rien du tout --}}
        @if($favoriPost)
        <div class="favoriPost p-0 m-0">
            <x-title>Actualité</x-title>
            <x-cadre>
                <h2 class="text-2xl font-bold mb-2">{{ $favoriPost->title }}</h2>
                <div class="p-0 w-full">
                    @if ($favoriPost->thumbnail)
                        <img src="{{ asset('uploads/' . $favoriPost->thumbnail) }}" alt="{{ $favoriPost->title }}" class="my-4 w-96ax-w-md m-auto rounded shadow">
                    @endif

                    @if ($favoriPost->video)
                        <div class="mt-4">
                            <iframe src="{{ $favoriPost->video }}" frameborder="0" allowfullscreen class="w-full h-64"></iframe>
                        </div>
                    @endif
                    @php
                        $allowedTags = '<p><br><b><i><strong><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><span>';
                        $cleanContent = strip_tags($favoriPost->content, $allowedTags);
                    @endphp

                    <p>{!!  nl2br($cleanContent) !!}</p>
                </div>
            </x-cadre>
        </div>
        @endif
        {{-- Elément post end --}}
        {{-- Elément maps start --}}
        <div class="maps">
            <x-title>Nous trouver</x-title>
            <x-cadre>
                <div id="map"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key={{ $banniere->google_map_api }}&callback=initMap&libraries=marker&v=beta"></script>
            </x-cadre>
        </div>
        {{-- Elément maps end --}}
    </section>
    {{-- Elément partenaires start --}}
    <div class="partenaire lg:pt-4">
    <x-title>Partenaires</x-title>
    <x-cadre>
        <div class="partenaires-flex">
            @foreach ($partenaires as $image)
                <div class="partenaire-item">
                    <img src="{{ asset('uploads/' . $image->img) }}" alt="{{ $image->titre }}" class="src">
                </div>
            @endforeach
        </div>
    </x-cadre>
    </div>
    {{-- Elément partenaires end --}}
</x-layout>