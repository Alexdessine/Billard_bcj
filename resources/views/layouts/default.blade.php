<!doctype html>
<html lang="fr" data-bs-theme="light">
<head>
    
<!-- Google Tag Manager -->
<script type="text/plain" data-category="analytics">
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MS4D37LJ');
</script>
<!-- End Google Tag Manager -->
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light">
  <meta name="description" content="@yield('meta_description', 'Site du club de billard de Joué-Lès-Tours')">
  <meta name="supported-color-schemes" content="light"><!-- (pluriel) utile Safari/iOS Mail -->
  <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: dark)">
  <script src="https://kit.fontawesome.com/a6212ffa8d.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
  <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v17.0"></script>

@vite([
    'resources/css/app.css', 
    'resources/css/nav.css',
    'resources/css/style.css',
    'resources/css/footer.css', 
    'resources/js/app.js',
    'resources/js/maps.js'
    ])
@stack('meta')
@stack('structured_data') {{-- pour injecter les JSON-LD par page --}}
<title>{{ $title }}</title>
<style>
    :root {color-scheme: light;}
</style>
<script>
  // Force clairement le thème clair
  document.documentElement.classList.remove('dark');
  localStorage.setItem('theme', 'light'); // si tu stockes le thème
  // DaisyUI / autres libs basées sur data-theme
  document.documentElement.setAttribute('data-theme', 'light');
</script>

</head>
<body class="min-h-screen flex flex-col">
<!-- Google Tag Manager (noscript) -->
@php $hasAnalytics = request()->cookies->get('cc_analytics') === '1'; @endphp
@if($hasAnalytics)
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MS4D37LJ"
          height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
@endif
<!-- End Google Tag Manager (noscript) -->
    <header class="pc">
        @php
            $accueil = \App\Models\SiteSetting::first();
        @endphp
        <div class="logo">
            <a href="/"><img src="{{ asset('uploads/' . $accueil->logo) }}" alt="logo BCJ" loading="lazy"></a>
        </div>
        <div class="discipline">
            @php
                $menus = \App\Models\Menu::where('actif', true)->get();
            @endphp

            @foreach($menus as $menu)
                <a href="{{ route($menu->nom) }}" class="img_menu {{ request()->segment(1) === $menu->nom ? 'active' : '' }}">
                    <img src="{{ asset('uploads/' . $menu->image) }}" alt="{{ ucfirst($menu->nom) }}" loading="lazy">
                </a>
            @endforeach
        </div>
        <div class="social">
            <p><a href="{{ route('calendrier') }}"><i class="fa-solid fa-calendar-days" title="calendrier"></i></a></p>
            <p><a href="{{ $accueil->facebook_page }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></p>
            <p><a href="{{ $accueil->youtube_page }}" target="_blank"><i class="fa-brands fa-youtube"></i></a></p>
            <p><a href="{{ route('contact') }}"><i class="fa-solid fa-envelope" title="contact@bcj37.fr"></i></a></p>
            @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            @if (Auth::guard('admin')->check())
                <p>
                    <a href="{{ admin_url() }}" title="Accès admin">
                        <i class="fa-solid fa-user-shield"></i>
                    </a>
                </p>
            @endif
        </div>
    </header>
    <header class="mobile">
        <div class="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('uploads/' . $accueil->logo) }}" alt="menu_bcj"></a>
        </div>
        <div class="burger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <section class="links">
            <nav class="menu">
                <ul>
                    @foreach($menus as $menu)
                        <li class="nav-link"><a href="{{ route($menu->nom) }}">{{ ucfirst($menu->nom) }}</a>
                        </li>
                    @endforeach
                        <li class="nav-link"><a href="{{ route('calendrier') }}">Calendrier</a>
                        <li class="nav-link"><a href="{{ route('contact') }}">Contact</a>
                        </li>
                        @if (Auth::guard('admin')->check())
                            <li class="nav-link">
                                <a href="{{ admin_url() }}">
                                    <i class="fa-solid fa-user-shield"></i> Admin
                                </a>
                            </li>
                        @endif
                </ul>
            </nav>
        </section>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>
    
    <x-footer/>
    <!-- Cookie Consent Banner -->
<div id="cc-banner" class="cc-hidden fixed bottom-0 left-0 right-0 z-50">
  <div class="max-w-4xl mx-auto m-4 p-4 rounded-2xl shadow-lg bg-white border text-gray-900">
    <div class="flex flex-col gap-3">
      <strong class="text-lg">Gestion des cookies</strong>
      <p class="text-sm">
        Nous utilisons des cookies essentiels au fonctionnement du site, ainsi que des cookies de mesure d’audience et
        de marketing (désactivés par défaut). Vous pouvez modifier vos choix à tout moment.
        <a href="politique-confidentialite" class="underline">En savoir plus</a>.
      </p>

      <div class="flex flex-wrap gap-2 mt-1">
        <button id="cc-accept-all" class="px-4 py-2 rounded-lg bg-gray-900 text-white">Tout accepter</button>
        <button id="cc-reject-all" class="px-4 py-2 rounded-lg border">Tout refuser</button>
        <button id="cc-customize" class="px-4 py-2 rounded-lg border">Personnaliser</button>
      </div>
    </div>
  </div>
</div>

<!-- Cookie Preferences Modal -->
<div id="cc-modal" class="cc-hidden fixed inset-0 z-[60]" aria-hidden="true">
  <div class="absolute inset-0 bg-black/40"></div>
  <div class="relative max-w-2xl mx-auto mt-24 bg-white text-gray-900 rounded-2xl shadow-xl p-6">
    <h2 class="text-xl font-semibold mb-2">Préférences cookies</h2>
    <p class="text-sm mb-4">Ajustez vos préférences par catégorie. Les cookies essentiels ne peuvent pas être désactivés.</p>

    <div class="space-y-4">
      <div class="flex items-start justify-between gap-4 p-3 border rounded-xl">
        <div>
          <div class="font-medium">Essentiels</div>
          <div class="text-sm text-gray-600">Nécessaires au fonctionnement du site (toujours actifs).</div>
        </div>
        <input type="checkbox" checked disabled class="h-5 w-5">
      </div>

      <div class="flex items-start justify-between gap-4 p-3 border rounded-xl">
        <div>
          <label for="cc-analytics" class="font-medium cursor-pointer">Mesure d’audience</label>
          <div class="text-sm text-gray-600">Ex : Google Analytics (paramétré sans pub).</div>
        </div>
        <input id="cc-analytics" type="checkbox" class="h-5 w-5">
      </div>

      <div class="flex items-start justify-between gap-4 p-3 border rounded-xl">
        <div>
          <label for="cc-marketing" class="font-medium cursor-pointer">Marketing</label>
          <div class="text-sm text-gray-600">Ex : tags publicitaires, remarketing, YouTube tracking.</div>
        </div>
        <input id="cc-marketing" type="checkbox" class="h-5 w-5">
      </div>
    </div>

    <div class="flex justify-end gap-2 mt-6">
      <button id="cc-save" class="px-4 py-2 rounded-lg bg-gray-900 text-white">Enregistrer</button>
      <button id="cc-cancel" class="px-4 py-2 rounded-lg border">Annuler</button>
    </div>
  </div>
</div>
<!-- End Cookie Consent Banner -->
<script>
/* -------------------------
   CONSENT MODE v2 (par défaut : denied)
   ------------------------- */
window.dataLayer = window.dataLayer || [];
function gtag(){ dataLayer.push(arguments); }

// valeurs par défaut strictes (avant consentement)
gtag('consent', 'default', {
  'ad_storage': 'denied',
  'analytics_storage': 'denied',
  'ad_user_data': 'denied',
  'ad_personalization': 'denied',
  'functionality_storage': 'granted', // nécessaire au fonctionnement
  'security_storage': 'granted'
});

// Helpers
const CC_KEY = 'cookieConsent';
const CC_COOKIE = 'cc'; // simple drapeau côté serveur si besoin

function setServerCookie(value) {
  // expire dans ~6 mois
  document.cookie = CC_COOKIE + '=' + encodeURIComponent(value) + '; Max-Age=' + (60*60*24*180) + '; Path=/; SameSite=Lax';
}
function getConsent() {
  try { return JSON.parse(localStorage.getItem(CC_KEY) || '{}'); } catch(e){ return {}; }
}
function setCatCookie(name, val){
    document.cookie = name + '=' + (val ? '1':'0') + '; Max-Age=' + (60*60*24*180) + '; Path=/; SameSite=Lax'
}
function saveConsent(obj) {
  localStorage.setItem(CC_KEY, JSON.stringify(obj));
  setServerCookie(obj && obj.status ? obj.status : 'unset');
  setCatCookie('cc_analytics', !!obj.analytics);
  setCatCookie('cc_marketing', !!obj.marketing);
}
function hasAnswered() {
  const c = getConsent();
  return !!c.status;
}

// activer les scripts différés par catégorie
function enableDeferred(category) {
  // scripts
  document.querySelectorAll('script[type="text/plain"][data-category="' + category + '"]').forEach(s => {
    const sc = document.createElement('script');
    // clone attributes
    for (const {name, value} of [...s.attributes]) {
      if (name === 'type') continue;
      if (name === 'data-category') continue;
      sc.setAttribute(name, value);
    }
    // contenu inline
    if (s.textContent.trim()) sc.textContent = s.textContent;
    s.parentNode.replaceChild(sc, s);
  });

  // iframes (ex: YouTube) différées
  document.querySelectorAll('iframe[data-category="' + category + '"][data-src]').forEach(ifr => {
    ifr.setAttribute('src', ifr.getAttribute('data-src'));
    ifr.removeAttribute('data-src');
  });
}

// appliquer Consent Mode selon préférences
function applyConsentToGTM(prefs) {
  const analyticsGranted = !!prefs.analytics;
  const marketingGranted = !!prefs.marketing;

  gtag('consent', 'update', {
    'analytics_storage': analyticsGranted ? 'granted' : 'denied',
    'ad_storage': marketingGranted ? 'granted' : 'denied',
    'ad_user_data': marketingGranted ? 'granted' : 'denied',
    'ad_personalization': marketingGranted ? 'granted' : 'denied'
  });

  // activer scripts selon choix
  if (analyticsGranted) enableDeferred('analytics');
  if (marketingGranted) enableDeferred('marketing');

  // notifier GTM
  dataLayer.push({
    event: 'cookie_consent_update',
    consent: {
      analytics: analyticsGranted,
      marketing: marketingGranted
    }
  });
}

// UI
const $banner = document.getElementById('cc-banner');
const $modal  = document.getElementById('cc-modal');
const $btnAccept = document.getElementById('cc-accept-all');
const $btnReject = document.getElementById('cc-reject-all');
const $btnCustomize = document.getElementById('cc-customize');
const $btnSave = document.getElementById('cc-save');
const $btnCancel = document.getElementById('cc-cancel');
const $chkAnalytics = document.getElementById('cc-analytics');
const $chkMarketing = document.getElementById('cc-marketing');

function openBanner(){ $banner.classList.remove('cc-hidden'); }
function closeBanner(){ $banner.classList.add('cc-hidden'); }
function openModal(){
  const c = getConsent();
  $chkAnalytics.checked = !!c.analytics;
  $chkMarketing.checked = !!c.marketing;
  $modal.setAttribute('aria-hidden','false');
  $modal.classList.remove('cc-hidden');
}
function closeModal(){
  $modal.classList.add('cc-hidden');
  $modal.setAttribute('aria-hidden','true');
}

$btnAccept.addEventListener('click', () => {
  const consent = { status: 'accepted_all', analytics: true, marketing: true, ts: Date.now() };
  saveConsent(consent);
  applyConsentToGTM(consent);
  closeBanner(); closeModal();
});

$btnReject.addEventListener('click', () => {
  const consent = { status: 'rejected_all', analytics: false, marketing: false, ts: Date.now() };
  saveConsent(consent);
  applyConsentToGTM(consent);
  closeBanner(); closeModal();
});

$btnCustomize.addEventListener('click', () => { openModal(); });

$btnSave.addEventListener('click', () => {
  const consent = {
    status: 'custom',
    analytics: $chkAnalytics.checked,
    marketing: $chkMarketing.checked,
    ts: Date.now()
  };
  saveConsent(consent);
  applyConsentToGTM(consent);
  closeBanner(); closeModal();
});

$btnCancel.addEventListener('click', () => { closeModal(); });

// Affichage au chargement
document.addEventListener('DOMContentLoaded', () => {
  // Honorer le DNT (optionnel) : si activé, ne pas afficher la bannière, tout en refusant
  if (navigator.doNotTrack === '1' || window.doNotTrack === '1') {
    if (!hasAnswered()) {
      const consent = { status: 'rejected_all_dnt', analytics: false, marketing: false, ts: Date.now() };
      saveConsent(consent);
      applyConsentToGTM(consent);
    }
    return; // pas de bannière
  }

  if (!hasAnswered()) {
    openBanner();
  } else {
    applyConsentToGTM(getConsent());
  }
});

// Bouton “Revoir mes choix” (à placer par ex. dans le footer)
window.openCookiePreferences = function(){ openModal(); };
</script>

</body>
@push('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Billard Club de Joué-Lès-Tours",
  "url": "https://bcj37.fr/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://bcj37.fr/recherche?q={query}",
    "query-input": "required name=query"
  }
}
</script>
@endpush