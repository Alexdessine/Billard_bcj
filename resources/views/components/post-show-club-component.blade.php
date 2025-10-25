@props(['id'])

@php
    use App\Helpers\PostHelper;
    $post = PostHelper::getPostById($id);
    $disciplines = [
        1 => 'blackball',
        2 => 'carambole',
        3 => 'snooker',
        4 => 'americain',
    ]

@endphp

        <div class="space-y-10 md:space-y-16">
        @php
            $disciplineName = $disciplines[$post->discipline] ?? null;
        @endphp
                {{-- Début du post --}}
                <div class="flex flex-col lg:flex-row pb-10 md:pb-16">
                    <div class="lg:w-5/12">
                        @php
                            // Récupère un ID YouTube robuste depuis youtu.be, youtube.com/watch?v=..., /embed/..., /shorts/...
                            function yt_id($url) {
                                if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([A-Za-z0-9_-]{11})~', $url, $m)) {
                                    return $m[1];
                                }
                                return $url; // au cas où on te passe déjà un ID
                            }
                            $vid = yt_id($post->video);
                        @endphp
                        @if ($post->video)
                            <div class="yt-inline" data-video-id="{{ $vid }}">
                                {{-- Zone vidéo avec ratio --}}
                                <div class="relative aspect-video bg-black overflow-hidden rounded-lg">
                                {{-- Thumbnail cliquable --}}
                                <button type="button"
                                        class="yt-thumb absolute inset-0 w-full h-full"
                                        onclick="ytInlinePlay(this)">
                                    <img src="https://img.youtube.com/vi/{{ $vid }}/hqdefault.jpg"
                                        alt="Miniature de la vidéo"
                                        class="w-full h-full object-cover">
                                    <span class="yt-play pointer-events-none"></span>
                                </button>

                                {{-- Iframe (sans src tant que pas consenti) --}}
                                <iframe class="yt-iframe hidden w-full h-full"
                                        title="YouTube player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen></iframe>
                                </div>

                                {{-- Petit mur de consentement inline (affiché si marketing refusé) --}}
                                <div class="yt-consent mt-3 rounded-lg border border-gray-200 bg-white p-4 text-sm">
                                Cette vidéo est hébergée par YouTube. Pour la lire, autorisez les cookies de marketing.
                                <div class="mt-2 flex gap-2">
                                    <button type="button" class="px-3 py-2 rounded bg-gray-900 text-white" onclick="ytEnableMarketingAndPlay(this)">Autoriser & lire</button>
                                    <button type="button" class="px-3 py-2 rounded border" onclick="openCookiePreferences && openCookiePreferences()">Préférences</button>
                                </div>
                                </div>
                            </div>
                            @else
                            {{-- <img class="w-full h-auto lg:max-h-none lg:h-full" src="{{asset('storage/uploads/' . $post->thumbnail) }}"> --}}
                            <img class="w-full h-auto lg:max-h-none lg:h-full" src="{{asset('storage/' . $post->thumbnail) }}">
                        @endif
                        {{-- <img class="w-full max-h-72 object-cover lg:max-h-none lg:h-full" src="{{ $post->thumbnail }}"> --}}
                    </div>
                    <div class="flex flex-col items-start mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
                        <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight">{{ $post->title }}</h1>
                        <ul class="flex flex-wrap gap-2">
                            @if (isset($post->discipline))
                                <li><a href="{{ route($disciplineName) }}" class="px-3 py-1 {{ $disciplineName }} text-indigo-50 rounded-full text-sm">{{ $disciplineName }}</a></li>
                            @endif
                            <li><a href="" class="px-3 py-1 bg-indigo-700 text-indigo-50 rounded-full text-sm">{{ $post->year }}</a></li>
                        </ul>
                        <p class="text-xl lg:text-2xl text-slate-600">
                            {!! nl2br($post->content) !!}
                        </p>
                        <time class="text-xs text-slate-400" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
                        @php
                            use Illuminate\Support\Str;

                            $backUrl = request()->query('back');      // récupère ?back=...
                            // Sécurise : on n'autorise que des URL internes à ton site
                            if (! $backUrl || ! Str::startsWith($backUrl, url('/'))) {
                                // fallback : page club par défaut (ou url()->previous() si tu préfères)
                                $backUrl = route('club');
                            }
                        @endphp

                        <a href="{{ $backUrl }}" class="flex items-center py-2 px-7 font-semibold bg-blue-900 transition text-slate-50 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            Retour
                        </a>
                    </div>
                </div>
                {{-- Fin du post --}}
            </div>

            <style>
.yt-play{position:absolute;inset:0;margin:auto;width:68px;height:48px;border-radius:14px;background:rgba(0,0,0,.6)}
.yt-play::before{content:"";position:absolute;left:26px;top:14px;border-style:solid;border-width:10px 0 10px 16px;border-color:transparent transparent transparent #fff}
</style>