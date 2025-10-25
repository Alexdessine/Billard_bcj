<x-layout>
{{-- Calque blanc transparent --}}
<div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu-club/>
    </section>
    <x-title>Le club</x-title>
    <x-cadre>
        <section>
    @php
        $currentYear = date('Y');
        $currentDecadeStart = floor($currentYear / 10) * 10;

        // Génération dynamique des décennies
        $decades = [
            'depuis_' . $currentDecadeStart => 'Depuis ' . $currentDecadeStart,
        ];

        for ($i = $currentDecadeStart - 10; $i >= 2000; $i -= 10) {
            $decades["{$i}_".($i + 9)] = "$i - " . ($i + 9);
        }

        $decades['avant_2000'] = 'Avant 2000';
    @endphp

    @foreach ($posts as $post)
    @if($post->discipline === null)
        @php
            $disciplines = [
                1 => 'blackball',
                2 => 'carambole',
                3 => 'snooker',
                4 => 'americain',
            ];
            $disciplineName = $disciplines[$post->discipline] ?? null;

            // Trouver la décennie du post
            $postDecade = collect($decades)->search(function ($label, $slug) use ($post) {
                return match ($slug) {
                    'depuis_' . floor(date('Y') / 10) * 10 => $post->year >= floor(date('Y') / 10) * 10,
                    'avant_2000' => $post->year < 2000,
                    default => preg_match('/(\d+)_(\d+)/', $slug, $matches) && $post->year >= $matches[1] && $post->year <= $matches[2],
                };
            });
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
                        <a href="{{ route('club.show', ['post' => $post, 'back' => url()->full()]) }}"><img class="w-50 max-h-none h-auto object-contain lg:max-h-none lg:h-50 lg:w-50 m-auto" src="{{asset('storage/' . $post->thumbnail) }}"></a>
                    @endif
                </div>
                <div class="contenu-texte">
                    <a href="{{ route('club.show', ['post' => $post, 'back' => url()->full()]) }}"><h3 class="font-bold text-slate-900 text-3xl lg:text-3xl leading-tight">{{ $post->title }}</h3></a>
                    <ul class="flex flex-wrap gap-1">
                        @if ($postDecade)
                            <li>
                                <a href="{{ route('club.byDecade', ['decade' => $postDecade]) }}" class="px-3 py-1 bg-indigo-700 text-indigo-50 rounded-full text-sm">
                                    {{ $post->year }}
                                </a>
                            </li>
                        @endif
                    </ul>
                    <p class="text-xl lg:text-xl text-slate-600">
                        {{ $post->excerpt }}
                    </p>
                    <a href="{{ route('club.show', ['post' => $post, 'back' => url()->full()]) }}" class="voirPlus flex items-center py-1 px-3 text-sm font-semibold bg-blue-900 transition text-slate-50 rounded-full w-36">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                        Lire la suite
                    </a>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</section>
</x-cadre>
<section class="pagination">
    <div class="mb-1 m-auto text-center justify-center">
        {{ $posts->links() }}
    </div>
</section>
</x-layout>

{{-- Modal vidéo (privacy-first) --}}
<div id="videoModal" class="fixed inset-0 z-50 bg-gray-800 bg-opacity-80 hidden items-center justify-center">
  <div class="relative w-full max-w-3xl">
    <div class="relative aspect-video bg-black">
      <button onclick="closeVideoModal()" class="absolute top-2 right-2 text-white text-3xl z-50">&times;</button>

      <!-- Iframe vidéo -->
      <iframe id="modalVideo"
              class="w-full h-full"
              title="YouTube player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen></iframe>

      <!-- Mur de consentement (affiché si marketing refusé) -->
      <div id="videoConsentWall"
           class="hidden absolute inset-0 flex items-center justify-center p-6">
        <div class="max-w-md rounded-xl bg-white/95 backdrop-blur border border-gray-200 p-5 text-center">
          <p class="mb-3">
            Cette vidéo est hébergée par YouTube. Pour la lire, autorisez les cookies de marketing.
          </p>
          <div class="flex items-center justify-center gap-2">
            <button class="px-4 py-2 rounded bg-gray-900 text-white"
                    onclick="allowMarketingAndPlay()">Autoriser & lire</button>
            <button class="px-4 py-2 rounded border"
                    onclick="openCookiePreferences && openCookiePreferences()">Préférences</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// ===== Helpers consent (utilise ton stockage s’il existe, sinon fallback localStorage) =====
function _getConsent(){
  try { return JSON.parse(localStorage.getItem('cookieConsent') || '{}'); } catch(e){ return {}; }
}
function _setConsent(obj){
  localStorage.setItem('cookieConsent', JSON.stringify(obj));
  if (typeof saveConsent === 'function') saveConsent(obj);            // si ta bannière expose saveConsent
  if (typeof applyConsentToGTM === 'function') applyConsentToGTM(obj); // MAJ Consent Mode / GTM
}
function marketingAllowed(){ return !!_getConsent().marketing; }

// ===== YouTube utils =====
function youtubeIdFrom(urlOrId){
  const s = String(urlOrId);
  const m = s.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))?([A-Za-z0-9_-]{11})/);
  return m ? m[1] : s;
}
function buildEmbedUrlNocookie(id, opts = { autoplay: true }){
  const p = new URLSearchParams({ rel:'0', hl:'fr', modestbranding:'1', autoplay: opts.autoplay ? '1' : '0' });
  return `https://www.youtube-nocookie.com/embed/${id}?${p.toString()}`;
}

// ===== Modal vidéo =====
let _pendingVideoId = null;

function openVideoModal(videoUrlOrId) {
  const modal  = document.getElementById('videoModal');
  const iframe = document.getElementById('modalVideo');
  const wall   = document.getElementById('videoConsentWall');

  const vid = youtubeIdFrom(videoUrlOrId);
  _pendingVideoId = vid;

  if (marketingAllowed()) {
    iframe.src = buildEmbedUrlNocookie(vid, { autoplay: true });
    wall.classList.add('hidden');
  } else {
    // Pas de requête vers YouTube avant consentement
    iframe.src = '';
    wall.classList.remove('hidden');
  }

  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeVideoModal() {
  const modal  = document.getElementById('videoModal');
  const iframe = document.getElementById('modalVideo');
  const wall   = document.getElementById('videoConsentWall');

  iframe.src = '';               // stoppe et nettoie
  wall.classList.add('hidden');  // prête pour la prochaine ouverture
  modal.classList.remove('flex');
  modal.classList.add('hidden');
  _pendingVideoId = null;
}

// Bouton "Autoriser & lire"
function allowMarketingAndPlay(){
  const c = _getConsent();
  const consent = { status: 'custom', analytics: !!c.analytics, marketing: true, ts: Date.now() };
  _setConsent(consent);

  if (_pendingVideoId) {
    const iframe = document.getElementById('modalVideo');
    const wall   = document.getElementById('videoConsentWall');
    iframe.src = buildEmbedUrlNocookie(_pendingVideoId, { autoplay: true });
    wall.classList.add('hidden');
  }
}
</script>

<style>
    /* page club start */

.encadrement{
    display: flex;
    flex-direction: row;
    /* background-color: green; */
    width: 81vw;
}

.contenu {
    /* background-color: green; */
    display: flex;
    margin: 15px 0;
}

.contenu .image{
    /* background-color: red; */
    width: 350px;
    display: flex;
    align-items:center;
}

.contenu-texte{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.voirPlus {
    width: 9rem;
}

/* page club end */

@media only screen and (max-width:867px){
        /* page club start */

        .encadrement {
        width: auto;
    }

    .contenu {
        flex-direction: column;
    }

    .contenu .image {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    /* page club end */
}
</style>