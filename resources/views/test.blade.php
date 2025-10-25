<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Espace licenciés — Maquette</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome (icônes) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

  <style>
    :root{
      --bg:#eef2f7; --card:#fff; --text:#0f172a; --muted:#64748b;
      --radius:14px; --shadow:0 10px 24px rgba(15,23,42,.08);
    }
    *{box-sizing:border-box}
    body{
      margin:0; background:var(--bg); color:var(--text);
      font:16px/1.4 ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
    }
    .topbar{
      position:sticky; top:0; z-index:10; backdrop-filter:saturate(120%) blur(6px);
      background:rgba(255,255,255,.7); border-bottom:1px solid #e5e7eb;
    }
    .container{max-width:1200px; margin:auto; padding:16px}
    .title{
      display:flex; align-items:center; gap:12px; font-weight:800; letter-spacing:.2px;
    }
    .title i{color:#2563eb}
    .subtitle{color:var(--muted); font-size:14px}

    /* --- GRID DES TUILES --- */
    .tiles{
      display:grid; gap:18px; margin:28px auto 22px;
      grid-template-columns:repeat(4, minmax(0,1fr));
    }
    @media (max-width:1100px){ .tiles{grid-template-columns:repeat(3, minmax(0,1fr));} }
    @media (max-width:820px){  .tiles{grid-template-columns:repeat(2, minmax(0,1fr));} }
    @media (max-width:540px){  .tiles{grid-template-columns:repeat(1, minmax(0,1fr));} }

    .tile{
      position:relative; display:flex; flex-direction:column; justify-content:center; align-items:center;
      height:120px; border-radius:var(--radius); color:#fff; text-decoration:none; box-shadow:var(--shadow);
      overflow:hidden; transition:.18s ease; isolation:isolate;
    }
    .tile::before{content:""; position:absolute; inset:0; background:radial-gradient(140px 140px at 60% 70%, rgba(255,255,255,.18), transparent 70%);}
    .tile:hover{transform:translateY(-2px); filter:brightness(1.05)}
    .tile .t-label{position:absolute; top:10px; left:12px; right:12px; text-align:center; font-weight:700; font-size:14px; text-shadow:0 1px 0 rgba(0,0,0,.2)}
    .tile .t-icon{
      width:58px; height:58px; display:grid; place-items:center; border-radius:50%;
      background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);
    }
    .tile .t-icon i{font-size:22px}

    /* Palettes (proches de ta maquette) */
    .slate  {background:linear-gradient(135deg,#64748b,#475569)}
    .indigo {background:linear-gradient(135deg,#6366f1,#4338ca)}
    .emerald{background:linear-gradient(135deg,#10b981,#0f766e)}
    .blue   {background:linear-gradient(135deg,#2563eb,#1e40af)}
    .amber  {background:linear-gradient(135deg,#f59e0b,#b45309)}
    .rose   {background:linear-gradient(135deg,#f43f5e,#be123c)}
    .zinc   {background:linear-gradient(135deg,#52525b,#27272a)}
    .cyan   {background:linear-gradient(135deg,#06b6d4,#0e7490)}

    /* --- BLOCS D’APERÇU --- */
    .grid-2{
      display:grid; gap:18px; grid-template-columns:2fr 1fr; margin:10px 0 40px;
    }
    @media (max-width:980px){ .grid-2{grid-template-columns:1fr} }

    .card{
      background:var(--card); border-radius:var(--radius); box-shadow:var(--shadow);
      padding:18px;
    }
    .card h3{margin:0 0 12px; font-weight:800; letter-spacing:.2px}
    .muted{color:var(--muted); font-size:14px}

    /* Agenda (fake) */
    .calendar{
      --cell: 44px;
      display:grid; grid-template-columns:repeat(7, 1fr); gap:8px; margin-top:12px;
    }
    .cal-head{display:contents}
    .cal-head div{font-weight:700; text-align:center; color:#334155}
    .cal-cell{
      height:var(--cell); border:1px solid #e5e7eb; border-radius:10px; display:flex; align-items:center; justify-content:center;
      background:#fafafa;
    }
    .cal-cell.busy{background:#e0ecff; border-color:#c3d5ff; color:#1e40af; font-weight:700}
    .cal-cell.meetup{background:#e7ffe0; border-color:#d5ffc3; color:#1eaf23; font-weight:700}
    .legend{display:flex; gap:10px; align-items:center; margin-top:10px}
    .badge{width:10px; height:10px; border-radius:50%}
    .b-blue{background:#2563eb}
    .b-green{background:#10b981}
    .b-amber{background:#f59e0b}

    /* Documents (fake) */
    .doc-list{margin-top:6px}
    .doc{display:flex; align-items:center; gap:10px; padding:10px 8px; border-radius:12px; border:1px solid #eef1f6; margin:8px 0; background:#fcfcfd}
    .doc i{color:#dc2626}
    .doc .meta{margin-left:auto; color:#64748b; font-size:12px}
    .doc .name{font-weight:700}

    /* Footer note */
    .note{
      text-align:center; color:#64748b; font-size:13px; margin:14px 0 28px;
    }
  </style>
</head>
<body>

  <!-- Barre supérieure / titre -->
  <div class="topbar">
    <div class="container">
      <div class="title">
        <i class="fa-solid fa-id-card"></i>
        <span>Espace licenciés</span>
      </div>
      <div class="subtitle">Maquette visuelle – navigation par tuiles & aperçus</div>
    </div>
  </div>

  <main class="container">

    <!-- Tuiles -->
    <section class="tiles">
      <a class="tile slate"  href="#">
        <div class="t-label">Agenda de la salle</div>
        <div class="t-icon"><i class="fa-solid fa-calendar-days"></i></div>
      </a>

      <a class="tile indigo" href="#">
        <div class="t-label">Documents internes</div>
        <div class="t-icon"><i class="fa-solid fa-file-pdf"></i></div>
      </a>

      <a class="tile emerald" href="#">
        <div class="t-label">Annuaire licenciés</div>
        <div class="t-icon"><i class="fa-solid fa-users"></i></div>
      </a>

      <a class="tile blue" href="#">
        <div class="t-label">Réservations</div>
        <div class="t-icon"><i class="fa-solid fa-clock"></i></div>
      </a>

      <a class="tile amber" href="#">
        <div class="t-label">Licences & cotisations</div>
        <div class="t-icon"><i class="fa-solid fa-receipt"></i></div>
      </a>

      <a class="tile rose" href="#">
        <div class="t-label">Messagerie</div>
        <div class="t-icon"><i class="fa-solid fa-envelope"></i></div>
      </a>

      <a class="tile zinc" href="#">
        <div class="t-label">Règlement intérieur</div>
        <div class="t-icon"><i class="fa-solid fa-shield-halved"></i></div>
      </a>

      <a class="tile cyan" href="#">
        <div class="t-label">Voir le site</div>
        <div class="t-icon"><i class="fa-solid fa-globe"></i></div>
      </a>
    </section>

    <!-- Aperçus (fictifs) -->
    <section class="grid-2">
      <!-- Agenda -->
      <div class="card">
        <h3><i class="fa-solid fa-calendar-days"></i> Agenda de la salle — Aperçu</h3>
        <div class="muted">Semaine du 14 → 20</div>

        <div class="calendar">
          <div class="cal-head">
            <div>Lun</div><div>Mar</div><div>Mer</div><div>Jeu</div><div>Ven</div><div>Sam</div><div>Dim</div>
          </div>

          <div class="cal-cell">14</div>
          <div class="cal-cell busy">15</div>
          <div class="cal-cell">16</div>
          <div class="cal-cell meetup">17</div>
          <div class="cal-cell busy">18</div>
          <div class="cal-cell">19</div>
          <div class="cal-cell">20</div>
        </div>

        <div class="legend">
          <span class="badge b-blue"></span><span class="muted">Compétition</span>
          <span class="badge b-green" style="margin-left:12px"></span><span class="muted">Entraînement</span>
          <span class="badge b-amber" style="margin-left:12px"></span><span class="muted">Réunion</span>
        </div>
      </div>

      <!-- Documents -->
      <div class="card">
        <h3><i class="fa-solid fa-file-pdf"></i> Documents internes — Aperçu</h3>
        <div class="doc-list">
          <div class="doc">
            <i class="fa-solid fa-file-pdf"></i>
            <div>
              <div class="name">Règlement intérieur 2025</div>
              <div class="muted">PDF • 1,2 Mo</div>
            </div>
            <span class="meta">MAJ 02/09</span>
          </div>

          <div class="doc">
            <i class="fa-solid fa-file-pdf"></i>
            <div>
              <div class="name">Planning compétitions T4</div>
              <div class="muted">PDF • 860 Ko</div>
            </div>
            <span class="meta">MAJ 28/08</span>
          </div>

          <div class="doc">
            <i class="fa-solid fa-file-pdf"></i>
            <div>
              <div class="name">Procédure réservation salle</div>
              <div class="muted">PDF • 540 Ko</div>
            </div>
            <span class="meta">MAJ 21/08</span>
          </div>
        </div>
      </div>
    </section>

    <p class="note">Maquette statique – couleurs & gabarits alignés avec l'admin. On branchera les vraies pages ensuite.</p>
  </main>
</body>
</html>
