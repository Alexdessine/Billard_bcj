<x-layout>
{{-- resources/views/test-accordion.blade.php --}}
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Test Bootstrap Accordion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

        <section>
        <x-title>Calendrier compétition Internationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionInternational">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_international, 'International') !!}
                </div>
            </x-cadre>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
