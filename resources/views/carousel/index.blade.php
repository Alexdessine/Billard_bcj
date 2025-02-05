<div class="container text-center my-3">
    <div class="row mx-auto my-auto justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/VILLE DE JOUÉ LES TOURS.png') }}" class="img-fluid h-100 w-100" alt="...">
                                {{-- <img src="{{ asset('img/partenaires/VILLE DE JOUÉ LES TOURS.png') }}" class="img-fluid h-100 w-100" alt="..."> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/Handisport horizontal quadri.png')}}" class="img-fluid h-100 w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/LBC logo_rvb_1200px-1.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/FFSA__1_-removebg-preview.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/logopizzadeluxe.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/test-lws-logo-1577535507-removebg-preview.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/lja-bureautique-logo.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/1280px-Logo_Tours_Métropole_Val_de_Loire.svg.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="">
                            <div class="card-img">
                                <img src="{{ asset('storage/partenaires/portofino.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>


<script>
    let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
    const minPerSlide = 3
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
        	next = items[0]
      	}
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})

</script>

<style>
    @media (max-width: 765px) {
    .carousel-inner{
        height: 250px;
        margin: auto;
        display: flex;
        align-items: center;
    }
    .carousel-inner .carousel-item > div {
        display: none;
    }
    .carousel-inner .carousel-item > div:first-child {
        display: block;
    }

        .carousel .card-img img{
        width: 200px !important;
        height: auto;
    }
            .carousel-inner .carousel-item-end.active,
    .carousel-inner .carousel-item-next {
      transform: translateX(100%);
    }
    
    .carousel-inner .carousel-item-start.active, 
    .carousel-inner .carousel-item-prev {
      transform: translateX(-100%);
    }
}

.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* medium and up screens */
@media screen and (min-width: 766px) and (max-width: 1300px) {
    .carousel-inner{
        height: 250px;
        margin: auto;
        display: flex;
        align-items: center;
    }
    .carousel .card-img img{
        width: 200px !important;
        height: auto;
        padding-left: 15px;
    }
        .carousel-inner .carousel-item-end.active,
    .carousel-inner .carousel-item-next {
      transform: translateX(33%);
    }
    
    .carousel-inner .carousel-item-start.active, 
    .carousel-inner .carousel-item-prev {
      transform: translateX(-33%);
    }
}

    @media (min-width: 1301px) {
            .carousel-inner{
        height: 120px;
        margin: auto;
        display: flex;
        align-items: center;
    }
    .carousel .card-img img{
        width: 200px !important;
        height: auto;
        padding-left: 15px;
    }
    .carousel-inner .carousel-item-end.active,
    .carousel-inner .carousel-item-next {
      transform: translateX(33%);
    }
    
    .carousel-inner .carousel-item-start.active, 
    .carousel-inner .carousel-item-prev {
      transform: translateX(-33%);
    }
}

.carousel-inner .carousel-item-end,
.carousel-inner .carousel-item-start { 
  transform: translateX(0);
}


</style>