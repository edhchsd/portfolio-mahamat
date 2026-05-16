<?php
require '../fonctions.php';

// Récupère le mot-clé de recherche via GET (lecture, pas écriture)
$mot_cle = nettoyer($_GET['q'] ?? '');

// Récupère tous les projets depuis fonctions.php
$tous_les_projets = get_projets();

// Filtre les projets selon le mot-clé saisi
$resultats = [];
if ($mot_cle !== '') {
    foreach ($tous_les_projets as $projet) {
        if (
            stripos($projet['titre'],       $mot_cle) !== false ||
            stripos($projet['description'], $mot_cle) !== false ||
            // Recherche aussi dans les technologies
            !empty(array_filter($projet['technologies'], fn($t) => stripos($t, $mot_cle) !== false))
        ) {
            $resultats[] = $projet;
        }
    }
} else {
    $resultats = $tous_les_projets;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes Projets — Mahamat Dillo</title>
  <link rel="stylesheet" href="../css/lol.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .search-bar {
      display: flex;
      gap: 0.75rem;
      max-width: 500px;
      margin: 0 auto 2.5rem;
    }
    .search-bar input {
      flex: 1;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: var(--card);
      color: var(--text);
      font-size: 0.95rem;
      outline: none;
      transition: border-color 0.2s;
    }
    .search-bar input:focus {
      border-color: var(--primary);
    }
    .search-bar button {
      padding: 0.75rem 1.2rem;
      background: var(--primary);
      color: #000;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.95rem;
      transition: opacity 0.2s;
    }
    .search-bar button:hover { opacity: 0.85; }
    .search-info {
      text-align: center;
      color: var(--muted);
      font-size: 0.85rem;
      margin-bottom: 1.5rem;
    }
    .no-results {
      text-align: center;
      padding: 3rem;
      color: var(--muted);
    }
    .no-results span { font-size: 3rem; display: block; margin-bottom: 1rem; }
  </style>
</head>
<body>

<?php require '../composants/navigation.php'; ?>

<main class="page">
  <section>
    <div class="section-label reveal">Ce que j'ai réalisé</div>
    <h2 class="section-title reveal">Mes Réalisations</h2>
    <div class="section-divider reveal"></div>
    <p style="text-align:center; color: var(--muted); margin-bottom: 2rem;" class="reveal">
      Voici un aperçu des projets que j'ai réalisés durant ma formation en informatique.
    </p>

    <!-- FORMULAIRE DE RECHERCHE -->
    <form method="GET" action="projets.php" class="reveal">
      <div class="search-bar">
        <input
          type="text"
          name="q"
          placeholder="Rechercher un projet, une technologie..."
          value="<?= nettoyer($mot_cle) ?>"
          aria-label="Rechercher un projet"
        >
        <button type="submit"><i class="fas fa-search"></i> Chercher</button>
      </div>
    </form>

    <!-- INFO SUR LES RÉSULTATS -->
    <?php if ($mot_cle !== '') : ?>
      <div class="search-info">
        <?= count($resultats) ?> résultat<?= count($resultats) > 1 ? 's' : '' ?>
        pour « <?= nettoyer($mot_cle) ?> »
        — <a href="projets.php" style="color: var(--primary);">Réinitialiser</a>
      </div>
    <?php endif; ?>

    <!-- GRILLE DE PROJETS -->
    <?php if (!empty($resultats)) : ?>
      <section class="projects-grid">
        <?php foreach ($resultats as $projet) : ?>
          <article class="project-card reveal">
            <div class="project-images">
              <?php if (!empty($projet['images'])) : ?>
                <?php foreach ($projet['images'] as $img) : ?>
                  <img src="../images/<?= nettoyer($img) ?>" alt="<?= nettoyer($projet['titre']) ?>">
                <?php endforeach; ?>
              <?php else : ?>
                <div style="display:flex;align-items:center;justify-content:center;height:150px;background:var(--card);font-size:3rem;">📁</div>
              <?php endif; ?>
            </div>
            <div class="project-info">
              <h2><?= nettoyer($projet['titre']) ?></h2>
              <p><?= nettoyer($projet['description']) ?></p>
              <div style="display:flex;flex-wrap:wrap;gap:0.4rem;margin-top:0.75rem;">
                <?php foreach ($projet['technologies'] as $tech) : ?>
                  <span class="tech"><?= nettoyer($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </section>
    <?php else : ?>
      <div class="no-results">
        <span>🔍</span>
        <p>Aucun projet ne correspond à « <strong><?= nettoyer($mot_cle) ?></strong> ».</p>
        <a href="projets.php" class="btn btn-outline" style="margin-top:1rem;">Voir tous les projets</a>
      </div>
    <?php endif; ?>

  </section>
</main>

<?php require '../composants/pied-de-page.php'; ?>
</body>
</html>
