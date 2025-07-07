<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a6212ffa8d.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
  <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <script async defer crossorigin="anonymous" 
    src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v17.0">
  </script>

@vite([
    'resources/css/app.css', 
    'resources/css/nav.css',
    'resources/css/style.css',
    'resources/css/footer.css', 
    'resources/js/app.js',
    'resources/js/maps.js'
    ])
@stack('meta')
</head>
<title>{{ $title }}</title>
<body class="min-h-screen flex flex-col">
    <header class="pc">
        @php
            $accueil = \App\Models\SiteSetting::first();
        @endphp
        <div class="logo">
            <a href="/"><img src="{{ asset('uploads/' . $accueil->logo) }}" alt="logo BCJ" loading="lazy"></a>
        </div>
        <div class="discipline">
            @php
                $menus = \App\Models\Menu::where('actif', true)->get();
            @endphp

            @foreach($menus as $menu)
                <a href="{{ route($menu->nom) }}" class="img_menu {{ request()->segment(1) === $menu->nom ? 'active' : '' }}">
                    <img src="{{ asset('uploads/' . $menu->image) }}" alt="{{ ucfirst($menu->nom) }}" loading="lazy">
                </a>
            @endforeach
        </div>
        <div class="social">
            <p><a href="{{ $accueil->facebook_page }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></p>
            <p><a href="{{ $accueil->youtube_page }}" target="_blank"><i class="fa-brands fa-youtube"></i></a></p>
            <p><a href="{{ route('contact') }}"><i class="fa-solid fa-envelope" title="contact@bcj37.fr"></i></a></p>
            @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            @if (Auth::guard('admin')->check())
                <p>
                    <a href="{{ admin_url() }}" title="Accès admin">
                        <i class="fa-solid fa-user-shield"></i>
                    </a>
                </p>
            @endif
        </div>
    </header>
    <header class="mobile">
        <div class="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('uploads/' . $accueil->logo) }}" alt=""></a>
        </div>
        <div class="burger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <section class="links">
            <nav class="menu">
                <ul>
                    @foreach($menus as $menu)
                        <li class="nav-link"><a href="{{ route($menu->nom) }}">{{ ucfirst($menu->nom) }}</a>
                        </li>
                    @endforeach
                        <li class="nav-link"><a href="{{ route('contact') }}">Contact</a>
                        </li>
                        @if (Auth::guard('admin')->check())
                            <li class="nav-link">
                                <a href="{{ admin_url() }}">
                                    <i class="fa-solid fa-user-shield"></i> Admin
                                </a>
                            </li>
                        @endif
                </ul>
            </nav>
        </section>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>
    
    <x-footer/>
    
</body>