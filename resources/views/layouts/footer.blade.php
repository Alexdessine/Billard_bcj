<footer>
<section class="footer">
    <div class="child">
        <img src="https://zupimages.net/up/23/24/h2eb.png" alt="" class="logo" />
    </div>
    <div class="child2">
        <h4>Contact</h4>
        <a href="https://www.facebook.com/groups/Billard.Club.Jocondien"><i class="fa-brands fa-facebook fa-xl" style="color: #ffffff;"></i><span>Billard Club de JOUE-LES-TOURS</span></a>
      <a><i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i><span>ericleroux2@wanadoo.fr</span></a>
      <a><i class="fa-solid fa-phone fa-xl" style="color: #ffffff;"></i><span>06.25.13.35.66</span></a>
      <a><i class="fa-sharp fa-solid fa-location-dot fa-xl" style="color: #ffffff;"></i><span>28 Rue Joseph Cugnot, 37300 Joué-lès-Tours</span></a>
    </div>
    <div class="child3">
        <h4>Liens</h4>
        <a href="/">Infos Club</a>
        <a href="/formation">Formation</a>
        <a href="/gallerie">Gallerie</a>
    </div>
</section>
<section class="copyright">
        <p>Réalisé par Alexandre Bourlier  &copy; 2023 - <?php echo date("Y")?></p>
</section>
</footer>
</html>

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