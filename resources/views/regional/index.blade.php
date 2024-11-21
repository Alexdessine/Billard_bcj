<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Gestion calendrier régional blackball</h2>
        </div>
        <div class="three">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="boutons">
                <a href="{{ route('regional.create') }}" class="btn btn-info"><i class="fa-solid fa-circle-plus"></i> Ajouter un tournoi</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Date</th>
                            <th scope="col">Lieux</th>
                            <th scope="col">Club organisateur</th>
                            <th scope="col">Statut</th>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <th>Actions</th>
                            @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regionaux as $regional)
                    <tr>
                        <td>{{ $regional->titre }}</td>
                        <td>du {{ date('d-m-Y', strtotime($regional->date_debut)) }} au {{ date('d-m-Y', strtotime($regional->date_fin)) }}</td>
                        <td>{{ $regional->lieu }}</td>
                        <td>{{ $regional->club }}</td>
                        <?php
                            $currentDate = date('Y-m-d');
                            $status = '';

                            if ($regional->date_debut <= $currentDate && $regional->date_fin >= $currentDate) {
                                $status = '<p class="text-green-600 font-bold">En cours</p>';
                            } elseif ($regional->date_debut > $currentDate) {
                                $status = '<p class="text-yellow-400 font-bold">A venir</p>';
                            } else {
                                $status = '<p class="text-red-600 font-bold">Terminé</p>';
                            }
                        ?>

                        <td><?= $status ?></td>
                        @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <td>
                            <a href="{{ route('regional.show', ['id' => $regional->id]) }}"><i class="fa-solid fa-eye mr-2"></i></a>
                            <a href="{{ route('regional.edit', ['id' => $regional->id]) }}"><i class="fa-solid fa-pen"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $regionaux->links() }}
            </div>
        </div>
    </div>
</body>
