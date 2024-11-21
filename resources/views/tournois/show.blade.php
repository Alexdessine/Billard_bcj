<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Gestion classement blackball</h2>
        </div>
        <div class="three">
            <form method="POST" action="{{ route('tournois.updateLiens') }}">
                @csrf
                @foreach ($liens as $lien) 
                    <div class="text-center m-4">
                        <label for="url-{{ $lien->id }}" class="font-bold mb-2">Classement {{ str_replace("_", " ", $lien->table_name) }}</label>
                        <input type="hidden" name="liens[{{ $lien->id }}][id]" value="{{ $lien->id }}">
                        <input type="hidden" name="liens[{{ $lien->id }}][table_name]" value="{{ $lien->table_name }}">
                        <input type="url" id="url-{{ $lien->id }}" name="liens[{{ $lien->id }}][url]" value="{{ $lien->url }}" class="form-control rounded-md bg-gray-100 text-sm">
                    </div>
                @endforeach
                <div class="m-auto text-center">
                    <button type="submit" class="btn btn-success">Valider les liens</button>
                </div>
            </form>
        </div>
    </div>
</body>
