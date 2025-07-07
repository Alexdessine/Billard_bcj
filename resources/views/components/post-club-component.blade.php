@php

    $disciplines = [
        1 => 'blackball',
        2 => 'carambole',
        3 => 'snooker',
        4 => 'americain',
    ];
@endphp

        @php
            $disciplineName = $disciplines[$post->discipline] ?? null;
        @endphp
        <div class="space-y-10 md:space-y-16 border-b">
            <div class="flex flex-col lg:flex-row pb-4 md:pb-16">
                <div class="lg:w-5/12">
                    <img class="w-full max-h-none object-cover lg:max-h-none lg:h-full" src="{{ asset('img/gallerie/4srRcUQRnDQvS3twjEOx1AaZU7Kt5k7IRw8c7cxN.jpg') }}">
                </div>
                <div class="flex flex-col items-start mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
                    <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight"><a href="{{ route("club.show", ['post' => $post]) }}">{{ $post->title }}</a></h1>
                    <p class="text-xl lg:text-2xl text-slate-600">
                        {{ $post->excerpt }}
                    </p>
                    <a href="{{ route("club.show", ['post' => $post]) }}" class="flex items-center py-2 px-7 font-semibold bg-blue-900 transition text-slate-50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                        Lire la suite
                    </a>
                </div>
            </div>
        </div>
    <div class="mb-5 m-auto">
        {{-- {{ $posts->links() }} --}}
    </div>
{{-- @endif --}}
