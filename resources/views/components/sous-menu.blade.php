@props(['discipline'])

@php
    $discipline = request()->segment(1);
    $disciplinesAvecSousMenu = ['blackball', 'carambole', 'snooker', 'americain'];

    $hasClassement = in_array($discipline, ['blackball', 'carambole', 'snooker', 'americain']);
    $hasCalendrier = in_array($discipline, ['blackball', 'carambole', 'snooker', 'americain']);
@endphp

@if (in_array($discipline, $disciplinesAvecSousMenu) &&
    (is_null(request()->segment(2)) || in_array(request()->segment(2), ['calendrier', 'classement', 'document']) || request()->routeIs("$discipline.show")))
    
    <div class="sous-menu-block-pc">
        <div class="btn-group d-flex flex-wrap justify-content-center text-center" role="group" aria-label="Sous-menu {{ ucfirst($discipline) }}">

            {{-- Actualités --}}
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                {{ request()->segment(2) === null ? 'checked' : '' }}>
            <label class="btn" for="btnradio1" onclick="location.href='{{ route("$discipline") }}'">
                Actualités
            </label>

            {{-- Classement --}}
            @if ($hasClassement)
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"
                    {{ request()->segment(2) === 'classement' ? 'checked' : '' }}>
                <label class="btn" for="btnradio2" onclick="location.href='{{ route("$discipline.classement") }}'">
                    Classement
                </label>
            @endif

            {{-- Calendrier --}}
            @if ($hasCalendrier)
                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"
                    {{ request()->segment(2) === 'calendrier' ? 'checked' : '' }}>
                <label class="btn" for="btnradio3" onclick="location.href='{{ route("$discipline.calendrier") }}'">
                    Calendrier
                </label>
            @endif

            {{-- Documents officiels --}}
            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off"
                {{ request()->segment(2) === 'document' ? 'checked' : '' }}>
            <label class="btn" for="btnradio4" onclick="location.href='{{ route("$discipline.document") }}'">
                Documents officiels
            </label>

        </div>
    </div>
@endif
