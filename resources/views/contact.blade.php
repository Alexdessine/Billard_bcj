<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
    </section>
    <section>
        <x-title>
            Nous contacter
        </x-title>
        <x-cadre>
            @if(session('success'))
                <div id="success-message" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <section class="p-4 mx-auto">
                <p class="pb-4">{!! nl2br(e($contact->message)) !!}</p>
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf
                <div class="space-y-12">
                    <div>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm/6 font-medium text-gray-900">Votre nom</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-gray-600 border-1 bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm/6 font-medium text-gray-900">Votre email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-gray-600 border-1 bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="message" class="block text-sm/6 font-medium text-gray-900">Votre message</label>
                                <div class="mt-2">
                                    <textarea name="message" id="message" rows="5" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border-gray-600 border-1 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pt-6">
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><i class="fa-solid fa-paper-plane pr-2"></i> Envoyer</button>
                        </div>
                    </div>
                </div>
                </form>


            </section>
        </x-cadre>
    </section>
</x-layout>

<script>
    setTimeout(() => {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = 0;
            setTimeout(() => msg.remove(), 500); // supprime le message après la transition
        }
    }, 5000); // 5000 ms = 5 secondes
</script>