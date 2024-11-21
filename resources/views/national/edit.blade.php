<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
            <h2>tournoi national :&nbsp <strong>{{ $national->titre }}</strong></h2>
            
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="pl-12">
            <form method="POST" action="{{ route('national.update', $national->id) }}">
                @csrf
                @method('PUT')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Intitulé du tournoi</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="nom du tournoi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $national->titre }}">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="club" class="block text-sm font-medium leading-6 text-gray-900">Club organisateur</label>
                                <div class="mt-2">
                                    <input type="text" name="club" id="club" autocomplete="club organisateur" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $national->club }}">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="date-debut" class="block text-sm font-medium leading-6 text-gray-900">Du</label>
                                <div class="mt-2">
                                    <input type="date" name="date-debut" id="date-debut" autocomplete="debut du tournoi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $national->date_debut }}">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                        <label for="date-fin" class="block text-sm font-medium leading-6 text-gray-900">Au</label>
                        <div class="mt-2">
                            <input type="date" name="date-fin" id="date-fin" autocomplete="fin du tournoi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $national->date_fin }}">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="adresse" class="block text-sm font-medium leading-6 text-gray-900">Adresse</label>
                        <div class="mt-2">
                            <input type="text" name="adresse" id="adresse" autocomplete="adresse" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('adresse', $adresse) }}">
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="ville" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
                        <div class="mt-2">
                            <input type="text" name="ville" id="ville" autocomplete="ville" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('ville', $ville) }}">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Région</label>
                        <div class="mt-2">
                            <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('region', $region) }}">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">Code postal</label>
                        <div class="mt-2">
                            <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('postal-code', $postalCode) }}">
                        </div>
                    </div>
                            
                    <div class="sm:col-span-3">
                        <label for="url" class="block text-sm font-medium leading-6 text-gray-900">Lien CueScore</label>
                        <div class="mt-2">
                            <input type="url" name="url" id="url" autocomplete="https" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $national->url }}">
                        </div>
                    </div>
                </div>

                <div class="mt-6 ml-10 mr-10 flex items-center justify-end gap-x-6">
                    <a href="{{ route('national') }}"  class="p-1.5 px-3 rounded-md bg-green-600 text-sm font-semibold leading-6 text-white">Annuler</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
