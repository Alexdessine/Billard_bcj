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
        width: 220px;
        border-radius: 12px;
        text-align: center;
        color: white;
        padding: 20px 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2);
        font-weight: bold;
    }

    .admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 2px 2px 18px rgba(0, 0, 0, 0.3);
    }

    .admin-card a {
        color: inherit;
        text-decoration: none;
        display: block;
    }

    .admin-card i {
        font-size: 3.5em;
        margin: 15px 0;
    }

    /* Variantes de couleurs par section */
    .admin-licencies {
        background: linear-gradient(135deg, #0f172a, #3b82f6); /* bleu nuit -> bleu */
    }
    .admin-home {
        background: linear-gradient(135deg, #065f46, #10b981); /* vert foncé -> vert émeraude */
    }
    .admin-posts {
        background: linear-gradient(135deg, #78350f, #f59e0b); /* orange foncé -> doré */
    }

    .admin-contact {
        background: linear-gradient(135deg, #1e3a8a, #6366f1); /* bleu profond -> violet lavande */
    }
    .admin-partenaires {
        background: linear-gradient(135deg, #991b1b, #f43f5e); /* rouge foncé -> rose */
    }

</style>

<div class="admin-grid">
    <div class="admin-card admin-licencies">
        <a href="{{ admin_url('club/licencies') }}">
            <strong>Licenciés</strong></br>
            <i class="fa-solid fa-users"></i>
        </a>
    </div>
    
    <div class="admin-card admin-home">
        <a href="{{ admin_url('indices/2/edit') }}">
            <strong>Message d'accueil</strong></br>
            <i class="fa-solid fa-house-user"></i>
        </a>
    </div>
    
    <div class="admin-card admin-posts">
        <a href="{{ admin_url('posts') }}">
            <strong>Gestion des posts</strong></br>
            <i class="fa-solid fa-newspaper"></i>
        </a>
    </div>
    
    <div class="admin-card admin-contact">
        <a href="{{ admin_url('contacts/1/edit') }}">
            <strong>Contact</strong><br>
            <i class="fa-solid fa-envelope"></i>
        </a>
    </div>

    <div class="admin-card admin-partenaires">
        <a href="{{ admin_url('partenaires') }}">
            <strong>Partenaires</strong><br>
            <i class="fa-solid fa-handshake-angle"></i>
        </a>
    </div>
    
</div>
