<x-layout></x-layout>

    <body>
        <h1 class="comite_titre text-4xl">Comité directeur</h1>
        <section class="comite">
            @foreach ($comites as $comite)
                <?php
                    // Définir une classe CSS en fonction du nombre de fonction
                    $fonctionClass = 'fonctions-' . min($comite['fonction_count'], 5); //Limite à a 5 pour éviter des classes trop nombreuses
                ?>
                <div class="carte <?= $fonctionClass ?>">
                    <div class="imgBx">
                        <img src="{{ asset('storage/' . $comite->image) }}" alt="">
                    </div>
                    <div class="comite_content">
                        <div class="details">
                            <h2 class="identite">{{ $comite->prenom }} {{ $comite->nom }}<br>
                                <span class="fonction">
                                    <?php
                                        echo membreFonction($comite['fonction']);
                                    ?>
                                </span>
                            </h2>
                            <div class="data">
                                <h3 class="text-center"><i class="fa-solid fa-phone mb-2"></i><br><span>{{ $comite->telephone }}</span></h3>
                                <h3 class="text-center mt-4"><i class="fa-solid fa-envelope"></i><br><span>{{ $comite->email }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </body>

<x-footer></x-footer>
</html>