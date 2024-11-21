<x-layout></x-layout>

<body>
    <section>
    <!-- Section club BCJ start -->
        <div class="accueil_section">
            <div class="accueil">
                <h5>Le club BCJ</h5>
            </div>
            <div class="content_accueil">
                <h6 class="text-xl">Billard Club de Joué-Lès-Tours : Une histoire riche et un leadership incontesté depuis 1977</h6>

                <img src="img/accueil/club.jpg" alt="photo salle billard" class="photo_club">
                <p><strong>Le Billard Club de Joué-Lès-Tours</strong> est un pilier du billard en France depuis sa création en 1977. En tant que <strong>premier club du pays en termes d'adhérents</strong>, il a marqué l'histoire du sport. 
                Il a notamment vu Christophe Lambert, numéro un français du blackball pendant de nombreuses années, représenter fièrement ses couleurs.</p>

                <p>Au-delà de la performance individuelle, <strong>le Billard Club de Joué-Lès-Tours est un lieu de rencontre </strong>pour les passionnés de tous niveaux. 
                Les joueurs débutants et confirmés se retrouvent dans <strong>une ambiance conviviale et stimulante.</strong> La diversité des membres 
                contribue à créer une atmosphère unique.</p>

                <p><strong>Le club possède une riche histoire</strong>, illustrée par ses trophées, photographies et souvenirs. 
                Les membres actuels sont fiers de cet héritage et s'efforcent de le préserver tout en construisant 
                l'avenir du club.</p>

                <p>Le Billard Club de Joué-Lès-Tours s'engage également dans la promotion du sport. Il organise régulièrement 
                des compétitions locales et régionales, encourageant ainsi les joueurs à se surpasser. Des cours et des 
                séances d'entraînement sont proposés aux débutants, les aidant à maîtriser les techniques de base.</p>

                <p>L'esprit de camaraderie et de partage est au cœur du Billard Club de Joué-Lès-Tours. Les membres se 
                soutiennent mutuellement et participent à des <strong>soirées amicales</strong>, des tournois internes et des 
                sorties organisées, renforçant les liens entre eux.</p>

                <p>En conclusion, le Billard Club de Joué-Lès-Tours est bien plus qu'un simple lieu de pratique du billard. 
                <strong>Avec son histoire glorieuse</strong>, son leadership incontesté et son engagement envers la promotion 
                du sport, il est un <strong>symbole de réussite et de passion.</strong> Que ce soit pour les joueurs passionnés 
                ou les curieux désireux de découvrir ce sport, le Billard Club de Joué-Lès-Tours offre un cadre idéal 
                pour vivre pleinement la passion du billard.</p>
            </div>
        </div>
    <!-- Section club BCJ end -->
    <!-- Section évènements Facebook + liens vers la page start -->
        <div class="partenaires_section">
            <div class="evenements_section">
                <div class="evenements_titre">
                <h5>Evènements</h5>
            </div>
            <div class="evenements_content">
                @foreach ($evenements as $evenement)
                    <a href="{{ $evenement->facebook }}" target="_blank">
                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="" class="evenement_img">
                    </a>
                @endforeach
            </div>
        </div>
    <!-- Section évènements Facebook + liens vers la page end -->
    <!-- Section Google maps start -->
        <div class="localisation_section">
            <div class="localisation_titre">
                <h5>Où sommes nous ?</h5>
            </div>
            <div class="localisation_content">
                <div id="map"></div>
                        <script
                            src=<?=$_ENV['GOOGLE_API_KEY']?>>
                            defer
                        </script>
                </div>
            </div>
    <!-- Section Google maps end -->
    <!-- Section Partenaires start -->
            <div class="partenaires_titre">
                <h5>Partenaires</h5>
            </div>
            <div class="partenaires_content">
                <div class="caroussel">
                    @include('carousel/index')
                </div>
            </div>
    <!-- Section Partenaires end -->
        </div>
    </section>
</body>

</html>


</body>

<x-footer></x-footer>



