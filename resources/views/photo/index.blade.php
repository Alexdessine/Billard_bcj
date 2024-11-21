<x-admin></x-admin>
    <body>
        <div class="wrapper">
            <div class="one">
                <x-adminNav></x-adminNav>
            </div>
            <div class="two">
                <h2>Photos club</h2>
            </div>
                    <!-- Section pour le message de succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="three">
                <div class="boutons">
                    <a href="{{ route('photos.create') }}" class="btn btn-info"><i class="fa-solid fa-circle-plus"></i> Ajouter des photos</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <th scope="col" colspan="3">Options</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($photos as $photo)
                        <tr>
                            <td><img src="{{ asset('storage/' . $photo->images) }}" alt="" width="320px"></td>
                            @if (Auth::check() && Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <td>
                                <a href="{{ route('photos.show', ['id' => $photo->id])}}"><i class="fa-solid fa-eye mr-2"></i></a>
                                <form action="{{ route('photos.destroy', ['id' => $photo->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="mt-4">
                {{ $photos->links() }}
            </div>
            </div>
        </div>
    </body>


<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cette photo?");
    }
</script>