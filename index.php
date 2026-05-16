<?php require 'fonctions.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mahamat Dillo — Portfolio</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require 'composants/navigation.php'; ?>

<main class="page">
  <section class="hero">
    <div class="hero-content">
      <span class="hero-tag">🎓 ESTM Dakar — Génie Logiciel &amp; Admin Réseaux</span>
      <h1 class="hero-title">
        Salut, je suis<br>
        <span class="highlight">Mahamat Dillo</span>
        <span class="accent-word"> Berkou</span>
      </h1>
      <p class="hero-sub">
        Étudiant en 2ème année à l'ESTM de Dakar, passionné par le développement web,
        les réseaux informatiques et l'électronique embarquée. Je transforme des idées
        en solutions numériques concrètes.
      </p>
      <div class="hero-actions">
        <a href="pages/projets.php" class="btn btn-primary">
          <i class="fas fa-folder-open"></i> Voir mes projets
        </a>
        <a href="pages/contact.php" class="btn btn-outline">
          <i class="fas fa-envelope"></i> Me contacter
        </a>
      </div>
      <div class="stats-bar">
        <div class="stat-item">
          <div class="stat-number">4+</div>
          <div class="stat-label">Projets</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">5</div>
          <div class="stat-label">Technologies</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">2</div>
          <div class="stat-label">Années d'études</div>
        </div>
      </div>
    </div>
    <div class="hero-image-wrap">
      <img src="images/mo.jpeg" alt="Mahamat Dillo Berkou" class="hero-avatar">
    </div>
  </section>

  <!-- APERÇU COMPÉTENCES -->
  <section style="padding-top: 0;">
    <div class="section-label reveal">Ce que je maîtrise</div>
    <h2 class="section-title reveal">Mes Compétences</h2>
    <div class="section-divider reveal"></div>
    <div class="skills-grid">
      <?php
      $competences = [
        ['🌐', 'HTML'], ['🎨', 'CSS'], ['⚡', 'JavaScript'],
        ['🐘', 'PHP'], ['🔧', 'Arduino'], ['🌐', 'Cisco'],
        ['📡', 'ESP32'], ['🛒', 'E-commerce'],
      ];
      foreach ($competences as $c) : ?>
        <div class="skill-card reveal">
          <span class="skill-icon"><?= $c[0] ?></span>
          <span class="skill-name"><?= $c[1] ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top: 2rem;">
      <a href="pages/competences.php" class="btn btn-outline">
        Voir toutes mes compétences <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </section>

  <!-- APERÇU PROJETS -->
  <section>
    <div class="section-label reveal">Ce que j'ai réalisé</div>
    <h2 class="section-title reveal">Projets Récents</h2>
    <div class="section-divider reveal"></div>
    <?php $projets = array_slice(get_projets(), 0, 3); ?>
    <div class="projects-grid">
      <?php foreach ($projets as $projet) : ?>
        <div class="project-card reveal">
          <div class="project-img-placeholder">
            <?php if (!empty($projet['images'])) : ?>
              <img src="images/<?= nettoyer($projet['images'][0]) ?>" alt="<?= nettoyer($projet['titre']) ?>" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
            <?php else : ?>
              📁
            <?php endif; ?>
          </div>
          <div class="project-body">
            <div class="project-tags">
              <?php foreach ($projet['technologies'] as $tech) : ?>
                <span class="tag"><?= nettoyer($tech) ?></span>
              <?php endforeach; ?>
            </div>
            <h3 class="project-title"><?= nettoyer($projet['titre']) ?></h3>
            <p class="project-desc"><?= nettoyer($projet['description']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top: 2rem;">
      <a href="pages/projets.php" class="btn btn-primary">
        Tous les projets <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </section>
</main>

<?php require 'composants/pied-de-page.php'; ?>
</body>
</html>
