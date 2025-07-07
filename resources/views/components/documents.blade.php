@props(['discipline'])

@php
    use App\Helpers\DocumentHelper;
    $documents = DocumentHelper::getDocumentByDiscipline($discipline);
@endphp

@if ($documents->isNotEmpty())
    @foreach ($documents as $document)
        <div class="documents">
            <span><i class="fa-solid fa-file-pdf"></i></span>
            <a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->title }}</a>
        </div>
    @endforeach
@endif