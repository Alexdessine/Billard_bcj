@php
    $currentYear = date('Y');
    $currentDecadeStart = floor($currentYear / 10) * 10;
    $currentDecade = request('decade'); // Décennie sélectionnée

    // Génération dynamique des décennies
    $decades = [
        'depuis_' . $currentDecadeStart => 'Depuis ' . $currentDecadeStart,
    ];

    for ($i = $currentDecadeStart - 10; $i >= 2000; $i -= 10) {
        $decades["{$i}_".($i + 9)] = "$i - " . ($i + 9);
    }

    $decades['avant_2000'] = 'Avant 2000';
@endphp

<div class="sous-menu-block-pc">
    <div class="btn-group  d-flex flex-wrap justify-content-center text-center" role="group" aria-label="Filtre par décennie">
        @foreach ($decades as $slug => $label)
            <input type="radio" class="btn-check" name="decade" id="btnradio-{{ $slug }}" autocomplete="off"
                {{ $currentDecade === $slug ? 'checked' : '' }} 
                onchange="window.location.href='{{ route('club.byDecade', ['decade' => $slug]) }}'">
            <label class="btn" for="btnradio-{{ $slug }}">{{ $label }}</label>
        @endforeach
    </div>
</div>
