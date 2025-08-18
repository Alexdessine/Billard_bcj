<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="carambole"></x-sous-menu>
    </section>
    {{-- <section> --}}
        {{-- <x-title>
            Classement PDF
        </x-title>
        <x-cadre>
            <iframe src="{{ asset('storage/pdf/carambole/excel/Une bande 23 joueurs.pdf') }}" width="100%" height="800px" style="border: none;"></iframe>
        </x-cadre> --}}
        @if ($fichiers->isNotEmpty())
            <section>
                <x-title>Classements PDF</x-title>

                <x-cadre>
                    {{-- <iframe id="pdfViewer" src="{{ asset($fichiers->first()['url']) }}" width="100%" height="800px" style="border: none;"></iframe> --}}
                    <iframe id="pdfViewer" src="{{ route('files.public', ['path' => str_replace('/storage/','', $fichiers->first()['url'])]) }}" width="100%" height="800px" style="border: none;"></iframe>
                </x-cadre>

                <div class="flex flex-wrap gap-3 mb-6 justify-center items-center">
                    @foreach ($fichiers as $fichier)
                        <button 
                            class="px-4 py-2 rounded bg-blue-700 text-white hover:bg-blue-800 transition"
                            onclick="document.getElementById('pdfViewer').src='{{ route('files.public', ['path' => str_replace('/storage/','',$fichier['url'])]) }}'">
                            {{ $fichier['nom'] }}
                        </button>
                    @endforeach
                </div>
            </section>
            @else
            <section>
                <x-title>Classements PDF</x-title>
            <x-cadre>
                <p class="text-center text-gray-600 py-10">Aucun fichier PDF trouvé.</p>
            </x-cadre>
        </section>
                @endif
    {{-- </section> --}}
</x-layout>