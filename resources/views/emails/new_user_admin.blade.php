<x-admin/>
<body class="registration">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 subscription">
            <div>
                <img class="mx-auto logo" src="https://zupimages.net/up/23/24/h2eb.png"
                        alt="Club bcj">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Nouvel utilisateur</h2>
            </div>
            <div class="text-center">
                <p class="font-bold">Bonjour Admin,</p>
                <p>Le nouvel utilisateur {{ $name }} vient d'être enregistrer. Vous trouverez ci-joint les informations de connexion à l'administration du site du billard club de Joué-Lès-Tours :</p>
                <p><strong>Email : </strong>{{ $email }}</p>
            </div>
        </div>
    </div>
</body>