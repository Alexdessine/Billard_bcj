<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
        </div>
        <div class="three">
            <div class="mt-4 text-center">
                @if ($user->regen == true)
                    <form class="mt-4 mb-4" method="POST" action="{{ route('utilisateurs.update', ['id' => $user->id]) }}">
                        @csrf
                        <input type="hidden" name="id" value="<?= $user['id']?>">
                        <button class="btn btn-danger text-xl"><i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Renouvelement de mot de passe demandé <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i></button>
                    </form>
                @endif
                <p>{{ $user->name }}</p>
                <p><strong>Compte crée le : </strong>{{ $user->created_at }}</p>
                @if ($user->created_at != $user->updated_at)
                    <p><strong>Compte mis à jour le : </strong> {{ $user->updated_at }}</p>
                @endif
                <div class="boutons">
                    <a href="/utilisateurs" class="btn btn-success"><i class="fa-solid fa-backward-step"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
</body>
