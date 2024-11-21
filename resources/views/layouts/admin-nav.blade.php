<nav>
    <a href="/"><img src="{{ asset('img/logo-bcj_v3.png') }}" alt="" class="img_bcj_admin"></a>
    <div class="m-auto mt-2 text-center">
        @if (Auth::check())
        <p class="font-bold">Bonjour {{ Auth::user()->name }}</p>
        @endif
    </div>
    <div class="m-auto text-center">
        <ul class="mt-0">
            <li><a href="{{ route('compte') }}" class="{{ request()->is('compte') ? 'active' : '' }}" {{ request()->is('compte') ? 'disabled' : '' }}><i class="fa-solid fa-user"></i> Compte</a></li>
        </ul>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button><i class="fa-solid fa-left-from-bracket"></i> Deconnexion</button>
        </form>
    </div>
    <ul>
        @if (Auth::check() && Auth::user()->role_id == 1)
            <li><a href="/utilisateurs" class="{{ request()->is('utilisateurs') ? 'active' : '' }}" {{ request()->is('utilisateurs') ? 'disabled' : '' }}><i class="fa-solid fa-user-group"></i> Utilisateurs</a></li>
            <li><a href="/licencies" class="{{ request()->is('licencies') ? 'active' : '' }}" {{ request()->is('licencies') ? 'disabled' : '' }}><i class="fa-solid fa-users"></i> Licenciés</a></li>
        @endif
        <li><a href="/evenements" class="{{ request()->is('evenements') ? 'active' : '' }}" {{ request()->is('evenements') ? 'disabled' : '' }}><i class="fa-solid fa-calendar-star"></i> Evènements</a></li>
        <li><a href="/national" class="{{ request()->is('national') ? 'active' : '' }}" {{ request()->is('national') ? 'disabled' : '' }}><i class="fa-solid fa-calendar-days"></i> Tournois Nationaux</a></li>
        <li><a href="/regional" class="{{ request()->is('regional') ? 'active' : '' }}" {{ request()->is('regional') ? 'disabled' : '' }}><i class="fa-solid fa-calendar-days"></i> Tournois Régionaux</a></li>
        <li><a href="/comites" class="{{ request()->is('comites') ? 'active' : '' }}" {{ request()->is('comites') ? 'disabled' : '' }}><i class="fa-solid fa-users"></i> Comités directeur</a></li>
        <li><a href="/photos" class="{{ request()->is('photos') ? 'active' : '' }}" {{ request()->is('photos') ? 'disabled' : '' }}><i class="fa-solid fa-image"></i> Gallerie</a></li>
        @if (Auth::check() && Auth::user()->role_id == 1)
            <li class="mt-4"><a href="/tournois" class="{{ request()->is('tournois') ? 'active' : '' }}" {{ request()->is('tournois') ? 'disabled' : '' }}><i class="fa-solid fa-ranking-star"></i> Résultats tournois</a></li>
            <li class="mb-4"><a href="/participants" class="{{ request()->is('participants') ? 'active' : '' }}" {{ request()->is('participants') ? 'disabled' : '' }}><i class="fa-solid fa-ballot-check"></i> Participants tournois</a></li>
        @endif
        <li><a href="/" target="blank"><i class="fa-solid fa-right-from-bracket"></i> Voir le site</a></li>
    </ul>
</nav>
