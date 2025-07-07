<head>
  <script src="https://kit.fontawesome.com/a6212ffa8d.js" crossorigin="anonymous"></script>
</head>

<style>
    .admin-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 40px;
    }

    .admin-card {
        width: 230px;
        border-radius: 10px;
        text-align: center;
        color: white;
        padding: 15px;
        transition: transform 0.2s ease;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .admin-card:hover {
        transform: translateY(-5px);
    }

    .admin-card a {
        color: inherit;
        text-decoration: none;
        display: block;
    }

    .admin-card i {
        font-size: 3.5em;
        margin-top: 10px;
    }

    /* Style spécifique à CueScore */
    .cuescore-section {
        background: linear-gradient(135deg, #4a148c, #7b1fa2);
    }
</style>
<h4>Pour mettre à jour les championnats individuels</h4>
<div class="admin-grid">
    <div class="admin-card cuescore-section">
        <a href="{{ admin_url('cuescore-nationals/1/edit/') }}">
            <strong>Liens Cuescore Nationaux</strong><br>
            <i class="fa-solid fa-link"></i>
        </a>
    </div>

    <div class="admin-card cuescore-section">
        <a href="{{ admin_url('cuescore-regionals/1/edit/') }}">
            <strong>Liens CueScore Régionaux</strong><br>
            <i class="fa-solid fa-link"></i>
        </a>
    </div>
</div>
<hr>
<h4>Pour mettre à jour les championnats par équipes</h4>
<div class="admin-grid">
    <div class="admin-card cuescore-section">
        <a href="{{ admin_url('cuescore-equipes-nationales') }}">
            <strong>Équipes Nationales</strong><br>
            <i class="fa-solid fa-people-group"></i>
        </a>
    </div>

    <div class="admin-card cuescore-section">
        <a href="{{ admin_url('cuescore-equipes-regionales') }}">
            <strong>Équipes Régionales</strong><br>
            <i class="fa-solid fa-people-group"></i>
        </a>
    </div>
</div>
