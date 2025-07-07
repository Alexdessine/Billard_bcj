<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="blackball"></x-sous-menu>
    </section>
    <section>
        <x-title>
            Actualités
        </x-title>
        <x-cadre>
            <x-post-component discipline="1"/>
        </x-cadre>
    </section>
</x-layout>

<style>
    /* page club start */

.encadrement{
    display: flex;
    flex-direction: row;
    /* background-color: green; */
    width: 81vw;
}

.contenu {
    /* background-color: green; */
    display: flex;
    margin: 15px 0;
}

.contenu .image{
    /* background-color: red; */
    width: 350px;
    display: flex;
    align-items:center;
}

.contenu-texte{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.voirPlus {
    width: 9rem;
}

/* page club end */

@media only screen and (max-width:867px){
        /* page club start */

        .encadrement {
        width: auto;
    }

    .contenu {
        flex-direction: column;
    }

    .contenu .image {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    /* page club end */
}
</style>