<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a6212ffa8d.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="../css/adminStyle.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <!-- Tagify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.9.7/dist/tagify.css" rel="stylesheet">
    <!-- Tagify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.9.7/dist/tagify.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-minimal.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @vite([
        'resources/css/app.css',
        'resources/css/adminStyle.css'])
    <title>BCJ - Admin</title>
</head>
</html>
<script>
    paceOptions = {
        ajax: true, // Activer le suivi des requêtes AJAX
        document: true, // Suivre le chargement du document
        eventLag: true, // Suivre les événements
        elements: {
            selectors: ['.my-element'] // Facultatif : cibler des éléments spécifiques
        },
        restartOnRequestAfter: 5, // Redémarre après 5 secondes pour les longues requêtes
        restartOnPushState: true, // Redémarre sur navigation par historique
        theme: 'minimal' // Remplacez par le nom du thème
    };
</script>
