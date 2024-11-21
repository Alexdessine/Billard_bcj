<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2>Enregistrer un nouveau membre du comité</h2>
            
        </div>
        <div class="three">
            <form method="POST" action="{{ route('comites.store') }}" enctype="multipart/form-data">
                @csrf
                        <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                                <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                                <div class="mt-2">
                                    <input type="text" name="nom" id="nom" autocomplete="nom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('nom') }}">
                                </div>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
                                <div class="mt-2">
                                    <input type="text" name="prenom" id="prenom" autocomplete="prenom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('prenom') }}">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="fonction" class="block text-sm font-medium leading-6 text-gray-900">Fonction(s)</label><span><p class="text-xs text-red-600">*5 maximum</p></span>
                                <div class="mt-2">
                                    <input type="text" name="fonction" id="fonction" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('fonction') }}">
                                </div>
                            </div>


                            <div class="sm:col-span-2">
                                <label for="telephone" class="block text-sm font-medium leading-6 text-gray-900">Téléphone</label>
                                <div class="mt-2">
                                    <input type="text" name="telephone" id="telephone" autocomplete="telephone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('telephone') }}" placeholder="00.00.00.00.00">
                                </div>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Photo de profil</label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Télécharger un fichier</span>
                                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">ou glisser déposer</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF jusqu'à 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="mt-6 ml-10 mr-10 flex items-center justify-end gap-x-6">
                    <a href="{{ route('comites') }}"  class="p-1.5 px-3 rounded-md bg-green-600 text-sm font-semibold leading-6 text-white">Annuler</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</body>


<script>
    var input = document.querySelector('#fonction');
    new Tagify(input);
</script>
