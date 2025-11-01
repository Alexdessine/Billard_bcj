@php
  $enabled = config('matomo.enabled');
  $url = config('matomo.url'); // doit finir par /
  $siteId = config('matomo.site_id');
@endphp

@if($enabled && app()->environment('production') && (!auth()->check() || !auth()->user()->hasRole('admin')))
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  // Consentement (GDPR) – active si tu utilises une bannière de consentement
  // _paq.push(['requireConsent']);

  // Détection SPAs/Livewire/Inertia : pageview sur navigation
  // Pour un site classique, ceci suffit :
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);

  (function() {
    var u="{{ rtrim($url, '/') }}/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '{{ $siteId }}']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="{{ rtrim($url, '/') }}/matomo.php?idsite={{ $siteId }}&rec=1" style="border:0;" alt=""/></p></noscript>
<!-- End Matomo Code -->
@endif
