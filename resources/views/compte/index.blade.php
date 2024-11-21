<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
                <h2>Compte de {{ $utilisateur->name }}</h2>
            </div>
                    <!-- Section pour le message de succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="three">
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
                <form action="/password" method="POST">
                    @csrf
                    <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <p><strong>Email : </strong>{{ $utilisateur->email }}</p>
                    </div>
                    <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="current_password" class="block text-sm font-medium leading-6 text-gray-900">Votre mot de passe</label>
                            <div class="mt-2">
                                <input type="password" name="current_password" id="current_password" autocomplete="current_password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('current_password') border-red-600 @enderror">
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Votre nouveau mot de passe</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <div id="password-requirements" class="mt-2 text-xs text-gray-700">
                                <p id="min-length" class="text-gray-500">Au moins 8 caractères</p>
                                <p id="uppercase" class="text-gray-500">Au moins une majuscule</p>
                                <p id="number" class="text-gray-500">Au moins un chiffre</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirmer votre mot de passe</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="password_confirmation"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 ml-10 mr-10 flex items-center justify-end gap-x-6">
                        <a href="{{ route('evenements') }}"  class="p-1.5 px-3 rounded-md bg-green-600 text-sm font-semibold leading-6 text-white">Annuler</a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                    </div>
                </form>
        </div>
            </div>
        </div>
    </body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const passwordInput = document.getElementById('password');
        const minLength = document.getElementById('min-length');
        const uppercase = document.getElementById('uppercase');
        const number = document.getElementById('number');

        passwordInput.addEventListener('input', function () {
            const value = passwordInput.value;

            // Vérification de la longueur minimale
            if (value.length >= 8) {
                minLength.classList.remove('text-gray-500');
                minLength.classList.add('text-green-600');
            } else {
                minLength.classList.add('text-gray-500');
                minLength.classList.remove('text-green-600');
            }

            // Vérification de la présence d'une majuscule
            if (/[A-Z]/.test(value)) {
                uppercase.classList.remove('text-gray-500');
                uppercase.classList.add('text-green-600');
            } else {
                uppercase.classList.add('text-gray-500');
                uppercase.classList.remove('text-green-600');
            }

            // Vérification de la présence d'un chiffre
            if (/\d/.test(value)) {
                number.classList.remove('text-gray-500');
                number.classList.add('text-green-600');
            } else {
                number.classList.add('text-gray-500');
                number.classList.remove('text-green-600');
            }
        });
    });
</script>
