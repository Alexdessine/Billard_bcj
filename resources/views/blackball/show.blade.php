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
        <x-sous-menu discipline="blackball"></x-sous-menu>
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