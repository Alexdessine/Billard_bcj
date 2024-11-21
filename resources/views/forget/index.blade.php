<x-admin/>
<body class="registration">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 subscription">
            <div>
                <img class="mx-auto logo" src="/img/logo/logo-bcj_v3.png"
                        alt="Club bcj">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Mot de passe oublié</h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('forget') }}" method="POST">
                @csrf
                <div class="-space-y-px rounded-md shadow-sm">

                    <div>
                        <label for="email" class="my-2">Adresse Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                                class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                placeholder="Adresse email" value="<?= old('email') ?>">
                    </div>
                
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Renouveller mon mot de passe
                    </button>
                </div>


            </form>
        </div>
    </div>
</body>