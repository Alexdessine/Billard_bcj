@props(['discipline'])

@php
    use App\Helpers\CalendrierHelper;
    $calendriers = CalendrierHelper::calendrierCarambole($discipline);
@endphp

@if ($calendriers->isNotEmpty())
    @foreach ($calendriers as $calendrier)
        <div class="documents">
            <span><i class="fa-solid fa-file-pdf"></i></span>
            <a href="{{ asset($calendrier->url) }}" target="_blank">{{ $calendrier->title }}</a>
        </div>
    @endforeach
@endif