
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<x-admin/>
<body class="registration">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="w-full max-w-md space-y-8 subscription">
            <div>
                <img class="mx-auto logo" src="/img/logo/logo-bcj_v3.png"
                        alt="Club bcj">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Inscription</h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="-space-y-px rounded-md shadow-sm">

                    <div>
                        <label for="name" class="my-2">Nom</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                                class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                placeholder="Nom prénom" value="{{ old('name') }}">
                    </div>

                    <div>
                        <label for="email" class="my-2">Adresse Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                                class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                placeholder="Adresse email" value="{{ old('email') }}">
                    </div>
                    
                    <div>
                        <label for="password" class="my-2">Mot de passe</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                placeholder="Mot de passe">
                    </div>

                    <div>
                        <label for="password_confirmation" class="my-2">Confirmer votre mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required
                            class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Mot de passe">
                    </div>

                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        S'inscrire
                    </button>
                </div>


            </form>
        </div>
    </div>
</body>