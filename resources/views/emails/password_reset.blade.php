<x-admin/>
<body class="registration">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 subscription">
            <div>
                <img class="mx-auto logo" src="https://zupimages.net/up/23/24/h2eb.png"
                        alt="Club bcj">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Réinitialisation de mot de passe</h2>
            </div>
            <div class="text-center">
                <p class="font-bold">Bonjour {{ $user->name }},</p>
                <p>Une demande de réinitialisation de mot de passe a été effectuée pour votre compte.</p>
                <p>Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet e-mail.</p>
                <p>Sinon, vous recevrez très bientôt un nouveau mot de passe.</p>
                <p>Admin BCJ</p>
            </div>
        </div>
    </div>
</body>