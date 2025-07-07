<h1>Articles de l'année {{ $year }}</h1>

@if($posts->count())
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }} ({{ $post->year }})</li>
        @endforeach
    </ul>
    {{ $posts->links() }} {{--  Pagination --}}
@else
    <p>Aucun article trouvé pour cette année</p>
@endif