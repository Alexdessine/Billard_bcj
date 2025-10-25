<footer>
    <div class="part-1">
        <div class="left">
            <a href="/"><img src="{{ asset('uploads/' . $contact_footer->logo) }}" alt=""></a>
        </div>
        <div class="middle">
            <p>Contact</p>
            <ul>
                <li><a href="{{ $contact_footer->facebook_page }}" target="_blank"><i class="fa-brands fa-facebook"></i> Billard Club de Joué-Lès-Tours</a></li>
                <li><a href="{{ route('contact') }}"><i class="fa-solid fa-envelope"></i> {{ $contact_footer->email }}</a></li>
                @if ($contact_footer->telephone)
                @php
                    $tel = preg_replace('/(\d{2})(?=\d)/', '$1 ', $contact_footer->telephone);
                @endphp
                <li><i class="fa-solid fa-phone"></i> <a href="tel:{{ $tel }}">{{ $tel }}</a></li>
                @endif
                <li><i class="fa-solid fa-location-dot"></i> {{ $contact_footer->adresse }}</li>
                <li>Affilié à la <a href="https://www.ffbillard.com" target="_blank"><u>Fédération Française de Billard</u></a></li>
            </ul>
        </div>
        <div class="right">
            <ul>
                @php
                    $menus = \App\Models\Menu::where('actif', true)->get();
                @endphp
                @foreach($menus as $menu)
                    <li><a href="{{ route($menu->nom)}}">{{ ucfirst($menu->nom) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="part-2">
        <div class="bottom"><p>Alexandre Bourlier &copy 2024 - {{ date('Y') }} | <a href="politique-confidentialite">Politique de confidentialité</a> | <a href="conditions-generales-utilisation">CGU</a> | <a href="mentions-legales">Mentions Légales</a></p></div>
    </div>

    <button type="button" onclick="openCookiePreferences()" class="btn btn-link p-0">
        <i class="fa-solid fa-key"></i>
    </button>

</footer>
