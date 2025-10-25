@push('meta')
    @php
        $url = request()->url();
        $title = $post->title;
        $description = $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 150);

        $isVideo = !empty($post->video);
        $youtubeId = $isVideo ? \Illuminate\Support\Str::afterLast($post->video, '/') : null;

        $image = $isVideo
            ? 'https://img.youtube.com/vi/' . $youtubeId . '/0.jpg'
            : secure_asset('uploads/' . $post->thumbnail);
    @endphp

    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ $image }}" />
    <meta property="og:image:alt" content="{{ $title }}" />

    @if($isVideo)
        <meta property="og:video" content="https://www.youtube.com/embed/{{ $youtubeId }}" />
        <meta property="og:video:secure_url" content="https://www.youtube.com/embed/{{ $youtubeId }}" />
        <meta property="og:video:type" content="text/html" />
        <meta property="og:video:width" content="1280" />
        <meta property="og:video:height" content="720" />
    @endif
@endpush
<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="snooker"></x-sous-menu>
    </section>
    <section>
        <x-title>
            Actualité
        </x-title>
        <x-cadre>
            <x-post-show-component id="{{ $post->id }}"/>
        </x-cadre>
    </section>
</x-layout>
<script>
function _getConsent(){ try { return JSON.parse(localStorage.getItem('cookieConsent')||'{}'); } catch(e){ return {}; } }
function _setConsent(obj){
  localStorage.setItem('cookieConsent', JSON.stringify(obj));
  if (typeof saveConsent==='function') saveConsent(obj);
  if (typeof applyConsentToGTM==='function') applyConsentToGTM(obj);
}
function marketingAllowed(){ return !!_getConsent().marketing; }

function buildEmbedUrlNocookie(id, autoplay=true){
  const p = new URLSearchParams({rel:'0',hl:'fr',modestbranding:'1',autoplay:autoplay?'1':'0'});
  return `https://www.youtube-nocookie.com/embed/${id}?${p.toString()}`;
}

function ytInlinePlay(btn){
  const wrap = btn.closest('.yt-inline');
  const vid  = wrap?.dataset.videoId;
  const iframe = wrap.querySelector('.yt-iframe');
  const consentBox = wrap.querySelector('.yt-consent');

  if (!vid || !iframe) return;

  if (marketingAllowed()){
    iframe.src = buildEmbedUrlNocookie(vid, true);
    iframe.classList.remove('hidden');
    btn.classList.add('hidden');
    consentBox?.classList.add('hidden');
  } else {
    // pas de requête vers YouTube -> on demande le consentement
    iframe.src = '';
    consentBox?.classList.remove('hidden');
  }
}

function ytEnableMarketingAndPlay(el){
  const wrap = el.closest('.yt-inline');
  const vid  = wrap?.dataset.videoId;
  const iframe = wrap.querySelector('.yt-iframe');
  const thumb  = wrap.querySelector('.yt-thumb');
  const c = _getConsent();
  const consent = { status:'custom', analytics:!!c.analytics, marketing:true, ts:Date.now() };

  _setConsent(consent);            // enregistre + notifie GTM si dispo
  if (vid && iframe){
    iframe.src = buildEmbedUrlNocookie(vid, true);
    iframe.classList.remove('hidden');
  }
  thumb?.classList.add('hidden');
  wrap.querySelector('.yt-consent')?.classList.add('hidden');
}

// Au chargement : si marketing déjà autorisé, on prépare les iframes pour un démarrage au clic
document.addEventListener('DOMContentLoaded', () => {
  if (!marketingAllowed()) return;
  document.querySelectorAll('.yt-inline').forEach(wrap => {
    const vid = wrap.dataset.videoId;
    if (!vid) return;
    // On ne lance pas automatiquement ; on attend le clic pour autoplay.
    const iframe = wrap.querySelector('.yt-iframe');
    if (iframe) iframe.dataset.src = buildEmbedUrlNocookie(vid, false);
    // Si tu veux qu'au clic ça ne repasse pas par le wall :
    wrap.querySelector('.yt-consent')?.classList.add('hidden');
  });
});
</script>