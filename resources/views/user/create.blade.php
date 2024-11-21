<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Enregistrer un nouvel utilisateur</h2>
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('utilisateurs.store') }}">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom - Prénom</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email utilisateur</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Permission</label>
                                <div class="mt-2">
                                    <select name="role" id="role-select" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="">-- Choisir un role pour l'utilisateur --</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" name="{{ $role->permission_level }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 ml-10 mr-10 flex items-center justify-end gap-x-6">
                    <a href="/utilisateurs"  class="p-1.5 px-3 rounded-md bg-green-600 text-sm font-semibold leading-6 text-white">Annuler</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</body>