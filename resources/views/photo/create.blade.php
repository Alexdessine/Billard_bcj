<x-admin></x-admin>
<body>
    <div class="wrapper">
        <div class="one">
            <x-adminNav></x-adminNav>
        </div>
        <div class="two">
            <h2>Ajouter des nouvelles photos</h2>
        </div>
        <div class="three">
            <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 ml-10 mr-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">Photos</label>
                                <div id="drop-zone" 
                                     class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 bg-gray-50"
                                     ondrop="handleDrop(event)" 
                                     ondragover="handleDragOver(event)">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="mt-4 text-sm leading-6 text-gray-600">Glissez-déposez vos fichiers ici ou</p>
                                        <label for="file-upload" class="cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>cliquez pour sélectionner</span>
                                            <input id="file-upload" name="file-upload[]" type="file" multiple class="sr-only">
                                        </label>
                                        <p class="text-xs leading-5 text-gray-600 mt-2">PNG, JPG, GIF jusqu'à 10MB</p>
                                    </div>
                                </div>
                                <div id="file-list" class="mt-4 text-sm text-gray-700"></div> <!-- Conteneur pour les fichiers -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 ml-10 mr-10 flex items-center justify-end gap-x-6">
                    <a href="/photos" class="p-1.5 px-3 rounded-md bg-green-600 text-sm font-semibold leading-6 text-white">Annuler</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</body>



<script>
const fileInput = document.getElementById('file-upload');
const fileListContainer = document.getElementById('file-list');
const dropZone = document.getElementById('drop-zone');

// Mettre à jour l'affichage des fichiers sélectionnés
function updateFileList(files) {
    fileListContainer.innerHTML = '';
    if (files.length === 0) {
        fileListContainer.textContent = 'Aucun fichier sélectionné.';
    } else {
        const fileNames = Array.from(files).map(file => file.name);
        fileListContainer.innerHTML = `<p class="text-xs text-red-600">Fichiers sélectionnés (${files.length}):</p><ul>${fileNames.map(name => `<li class="text-xs text-red-600">${name}</li>`).join('')}</ul>`;
    }
}

// Gestion du changement d'input file
fileInput.addEventListener('change', (event) => {
    updateFileList(event.target.files);
});

// Empêcher le comportement par défaut pour le drag and drop
function handleDragOver(event) {
    event.preventDefault();
    dropZone.classList.add('bg-gray-100'); // Style visuel pour le drag over
}

// Réinitialiser le style après le drag
function handleDragLeave(event) {
    dropZone.classList.remove('bg-gray-100');
}

// Gestion du drop des fichiers
function handleDrop(event) {
    event.preventDefault();
    dropZone.classList.remove('bg-gray-100');

    const files = event.dataTransfer.files;
    fileInput.files = files; // Ajouter les fichiers au champ input
    updateFileList(files);
}

// Événements pour le drag and drop
dropZone.addEventListener('dragover', handleDragOver);
dropZone.addEventListener('dragleave', handleDragLeave);
dropZone.addEventListener('drop', handleDrop);

</script>
