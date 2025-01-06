<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a6212ffa8d.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        @vite([
            'resources/css/app.css',
            'resources/css/footer.css',
            'resources/css/nav_style.css',
            'resources/css/bootstrap.css',
            'resources/css/mentions.css',
        ])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-minimal.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
        <title>{{ config('app.name') }}</title>
    </head>
<body class="antialiased">
    
    <div class="header">
    <!-- Affichage lien facebook, email, telephone sur mobile -->
    <div class="media_mobil">
        <a href="https://www.facebook.com/groups/Billard.Club.Jocondien"><i class="fa-brands fa-facebook fa-xl" style="color: #ffffff;"></i></a>
        <a href=""><i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i></a>
        <a href=""><i class="fa-solid fa-phone fa-xl" style="color: #ffffff;"></i></a>
    </div>
    <!-- Affichage logo BCJ -->
    <div class="logo">
        <a href="{{ route('index') }}"><img src="https://zupimages.net/up/23/24/h2eb.png" alt="" class="logo" /></a>
    </div>
    <!-- Affichage image blackball/carambole/snooker sur pc (Non visible sur mobile) -->
    <div class="top_img_bcj">
        <img src="https://zupimages.net/up/23/19/rel3.png" alt="" class="top_img_bcj" />
    </div>
    <!-- Affichage lien facebook, email, telephone sur pc -->
    <div class="media">
        <a href="https://www.facebook.com/groups/Billard.Club.Jocondien"><i class="fa-brands fa-facebook fa-xl" style="color: #ffffff;"></i></a>
        <a><i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i><span class="tooltiptext1">ericleroux2@wanadoo.fr</span></a>
        <a><i class="fa-solid fa-phone fa-xl" style="color: #ffffff;"></i><span class="tooltiptext">06 25 13 35 66</span></a>
    </div>
</div>
<!-- Affichage logo BCJ sur mobile -->
<div id="logo_mob">
    <a href="{{ route('index') }}" style="border: none;"><img src="https://zupimages.net/up/23/24/h2eb.png" alt="" class="logo" /></a>
</div>
<!-- Menu mobile start -->
<nav>
    <!-- Affichage menu avec icone bille de billard -->
    <label for="drop" class="toggle">Menu<br><i class="fa-solid fa-pool-8-ball fa-xl" style="color: #000;"></i></label>
    <input type="checkbox" id="drop">
    <ul class="menu">
        <li>
            <!-- First Tier Drop Down -->
            <label for="drop-1" class="toggle">Infos club +</label>
            <a href="{{ route('index') }}">Infos club</a>
            <input type="checkbox" id="drop-1"/>
            <ul>
                <li><a href="{{ route('presentation') }}">Présentation du BCJ</a></li>
                <li><a href="{{ route('comite') }}">Comité directeur</a></li>
                <li><a href="{{ route('adhesion') }}">Comment adhérer ?</a></li>
            </ul> 
        </li>
        <li>
            <!-- First Tier Drop Down -->
            <label for="drop-2" class="toggle">Compétitions +</label>
            <a href="#">Compétitions</a>
            <input type="checkbox" id="drop-2"/>
            <ul>
                <li><a href="{{ route('blackball') }}">BlackBall</a></li>
                <li><a href="{{ route('carambole') }}">Carambole</a></li>
                <li><a href="{{ route('snooker') }}">Snooker</a></li>
            </ul>
        </li>
        <li><a href="{{ route('formation') }}">Formation</a></li>
        <li><a href="{{ route('gallerie') }}">Gallerie</a></li>
    </ul>
</nav>
<!-- Menu mobile end -->
<!-- Menu pc start -->
<nav class="navbar">
    <ul class="menu">
        <li>
            <a href="{{ route('index') }}">Infos club</a>
            <ul class="dropdown">
                <li><a href="{{ route('presentation') }}">Présentation du BCJ</a></li>
                <li><a href="{{ route('comite') }}">Comité directeur</a></li>
                <li><a href="{{ route('adhesion') }}">Comment adhérer ?</a></li>
            </ul>  
        </li>
        <li>
            <a href="#">Compétitions</a>
            <ul class="dropdown">
                <li><a href="{{ route('blackball') }}">BlackBall</a></li>
                <li><a href="{{ route('carambole') }}">Carambole</a></li>
                <li><a href="{{ route('snooker') }}">Snooker</a></li>
            </ul>
        </li>
        <li><a href="{{ route('formation') }}">Formation</a></li>
        <li><a href="{{ route('gallerie') }}">Gallerie</a></li>
    </ul>
</nav>
<!-- Menu pc end -->



<script>
  (function($){
    $(document).ready(function(){
      var offset = $(".navbar").offset().top;
      $(document).scroll(function(){
        var scrollTop = $(document).scrollTop();
        if(scrollTop > offset){
          $(".navbar").css("position", "fixed");
        }
        else{
          $(".navbar").css("position", "static");
        }
      });
  });
  });
</script>

<script>
    if (!document.cookie.includes('iubenda_consent_given=true')) {
    _iub.cs.api.showBanner();
} else {
    console.log('Consent already given');
}
</script>