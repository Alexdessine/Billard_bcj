<x-admin/>
<body class="registration">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 subscription">
            <div>
                <img class="mx-auto logo" src="https://zupimages.net/up/23/24/h2eb.png"
                        alt="Club bcj">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Bienvenue !</h2>
            </div>
            <div class="text-center">
                <p class="font-bold">Bonjour {{ $user->name }},</p>
                <p>Vous trouverez ci-joint les informations de connexion à l'administration du site du billard club de Joué-Lès-Tours :</p>
                <p><strong>Email : </strong>{{ $email }}</p>
                <p><strong>Mot de passe : </strong>{{ $password }}</p>
                <p>Pour des raisons de sécurité, nous vous invitons à le modifier rapidement dans la rubrique compte.</p>
                <p>Admin BCJ</p>
            </div>
        </div>
    </div>
</body>