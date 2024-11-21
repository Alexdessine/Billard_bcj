<x-layout></x-layout>
    <body>
        <section>
            <div class="presentation_section carambole gallerie">
                <div class="presentation_titre">
                    <h5>Gallerie</h5>
                </div>
                    <div class="presentation_content container mx-auto px-5 py-5 lg:px-32 lg:pt-24">
                        <div class="-m-1 flex flex-wrap md:-m-2">
                            <div class="flex w-70% flex-wrap">
                                @foreach ($galleries as $gallerie)
                                <div class="w-1/2 p-1 md:p-2">
                                    <img
                                    alt="gallery"
                                    class="block h-full w-full rounded-lg object-cover object-center"
                                    src="{{ asset('storage/' . $gallerie->images) }}" />
                                </div>
                                @endforeach
                            </div>
                            <div class="text-xs w-100">
                                <p class="text-right pr-2 w-100" style="text-align:right;"><a href="https://www.facebook.com/gerald.bernard.96" target="_blank">Crédit photos : Gérald bernard &copy</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="ml-8 mr-8 lg:mr-8">

                        {{ $galleries->links() }}
                    </div>
                </div>
        </section>
    </body>
<x-footer></x-footer>
</html>
