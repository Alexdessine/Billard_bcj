@props(['discipline'])

@php
    use App\Helpers\CalendrierHelper;
    use Illuminate\Support\Facades\Storage;

    $calendriers = CalendrierHelper::calendrierParDiscipline($discipline);
@endphp

@if ($calendriers->isNotEmpty())
    @foreach ($calendriers as $calendrier)
        <div class="documents">
            <span><i class="fa-solid fa-file-pdf"></i></span>
            {{-- Supposons que $calendrier->url == 'ftp/mon-fichier.pdf' --}}
            <a href="{{ Storage::url($calendrier->url) }}" target="_blank">
                {{ $calendrier->title }}
            </a>
        </div>
    @endforeach
@endif