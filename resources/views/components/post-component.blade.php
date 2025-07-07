@props(['discipline'])

@php
    use App\Helpers\PostHelper;
    $posts = PostHelper::getPostByDiscipline($discipline);
    $disciplines = [
        1 => 'blackball',
        2 => 'carambole',
        3 => 'snooker',
        4 => 'americain',
    ]


@endphp

@if ($posts->isNotEmpty())
@foreach ($posts as $post)
@php
$disciplineName = $disciplines[$post->discipline] ?? null;
@endphp
<div class="encadrement border-b">
    <div class="contenu">
        <div class="image">
           @if ($post->video)
                {{-- Miniature cliquable (tu peux mettre une image ou un bouton) --}}
                <div class="cursor-pointer" onclick="openVideoModal('{{ $post->video }}')">
                    <img src="https://img.youtube.com/vi/{{ \Illuminate\Support\Str::afterLast($post->video, '/') }}/0.jpg" class="w-50 h-auto object-cover m-auto" alt="Miniature de la vidéo">
                </div>
            @else
                <a href="{{ route('club.show', ['post' => $post, 'back' => url()->full()]) }}"><img class="w-50 max-h-none h-auto object-contain lg:max-h-none lg:h-50 lg:w-50 m-auto" src="{{asset('uploads/' . $post->thumbnail) }}"></a>
            @endif
        </div>
        <div class="contenu-texte">
            <a href="{{ route("{$disciplineName}.show", ['post' => $post, 'back' => url()->full()]) }}"><h3 class="font-bold text-slate-900 text-3xl lg:text-3xl leading-tight">{{ $post->title }}</h3></a>
            <ul class="flex flex-wrap gap-1">
                {{-- A mettre si tous les posts de toutes les disciplines sont afficher --}}
                {{-- @if ($disciplineName)
                    <li>
                        <a href="{{ route($disciplineName) }}" class="px-3 py-1 {{ $disciplineName }} text-indigo-50 rounded-full text-sm">
                            {{ $disciplineName }}
                        </a>
                    </li>
                @endif --}}
            </ul>
            <p class="text-xl lg:text-xl text-slate-600">
                {{ $post->excerpt }}
            </p>
            <a href="{{ route("{$disciplineName}.show", ['post' => $post, 'back' => url()->full()]) }}" class="voirPlus flex items-center py-1 px-3 text-sm font-semibold bg-blue-900 transition text-slate-50 rounded-full w-36">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                Lire la suite
            </a>
        </div>
    </div>
</div>
@endforeach
@else
<p>Aucun post disponible.</p>
@endif

</section>
<section class="pagination">
<div class="mb-1 m-auto text-center justify-center">
{{ $posts->links() }}
</div>
</section>
{{-- Modal vidéo --}}
<div id="videoModal" class="fixed inset-0 z-50 bg-gray-800 bg-opacity-80  hidden items-center justify-center">
    <div class="relative w-full max-w-3xl aspect-video">
        <button onclick="closeVideoModal()" class="absolute top-2 right-2 text-white text-3xl z-50">&times;</button>
        <iframe id="modalVideo" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<script>
    function openVideoModal(videoUrl) {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('modalVideo');

        iframe.src = videoUrl + '?autoplay=1';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('modalVideo');

        iframe.src = ''; // Reset la vidéo
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>

