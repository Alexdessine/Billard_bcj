@props(['id'])

@php
    use App\Helpers\PostHelper;
    $post = PostHelper::getPostById($id);
    $disciplines = [
        1 => 'blackball',
        2 => 'carambole',
        3 => 'snooker',
        4 => 'americain',
    ]

@endphp

        <div class="space-y-10 md:space-y-16">
        @php
            $disciplineName = $disciplines[$post->discipline] ?? null;
        @endphp
                {{-- Début du post --}}
                <div class="flex flex-col lg:flex-row pb-10 md:pb-16">
                    <div class="lg:w-5/12">
                        @if ($post->video)
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe width="100%" height="315" src="{{ $post->video }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <img class="w-full h-auto lg:max-h-none lg:h-full" src="{{asset('storage/uploads/' . $post->thumbnail) }}">
                        @endif
                        {{-- <img class="w-full max-h-72 object-cover lg:max-h-none lg:h-full" src="{{ $post->thumbnail }}"> --}}
                    </div>
                    <div class="flex flex-col items-start mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
                        <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight">{{ $post->title }}</h1>
                        <ul class="flex flex-wrap gap-2">
                            @if (isset($post->discipline))
                                <li><a href="{{ route($disciplineName) }}" class="px-3 py-1 {{ $disciplineName }} text-indigo-50 rounded-full text-sm">{{ $disciplineName }}</a></li>
                            @endif
                            <li><a href="" class="px-3 py-1 bg-indigo-700 text-indigo-50 rounded-full text-sm">{{ $post->year }}</a></li>
                        </ul>
                        <p class="text-xl lg:text-2xl text-slate-600">
                            {!! nl2br($post->content) !!}
                        </p>
                        <time class="text-xs text-slate-400" datetime="{{ $post->created_at }}">{{ $post->created_at }}</time>
                        <a href="{{ route('club') }}" class="flex items-center py-2 px-7 font-semibold bg-blue-900 transition text-slate-50 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            Retour
                        </a>
                    </div>
                </div>
                {{-- Fin du post --}}
            </div>