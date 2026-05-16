<?php require '../fonctions.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compétences — Mahamat Dillo</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require '../composants/navigation.php'; ?>

<main class="page">
  <section>
    <div class="section-label reveal">Ce que je sais faire</div>
    <h2 class="section-title reveal">Mes Compétences</h2>
    <div class="section-divider reveal"></div>

    <?php
    // Tableau des catégories de compétences
    $categories = [
      [
        'icone'   => 'fas fa-code',
        'titre'   => 'Développement Web',
        'skills'  => [
          ['🌐', 'HTML5'], ['🎨', 'CSS3'], ['⚡', 'JavaScript'],
          ['🐘', 'PHP'], ['🛒', 'E-commerce'], ['📱', 'Responsive'],
        ],
      ],
      [
        'icone'   => 'fas fa-network-wired',
        'titre'   => 'Réseaux & Infrastructure',
        'skills'  => [
          ['🌐', 'Cisco'], ['📡', 'DHCP'],
          ['🔗', 'IP Statique'], ['🛡️', 'Packet Tracer'],
        ],
      ],
      [
        'icone'   => 'fas fa-microchip',
        'titre'   => 'Électronique Embarquée',
        'skills'  => [
          ['🔧', 'Arduino'], ['📡', 'ESP32'], ['💡', 'LED / LCD'],
          ['🌡️', 'Capteurs'], ['🚪', 'IoT / Domotique'],
        ],
      ],
      [
        'icone'   => 'fas fa-tools',
        'titre'   => 'Outils & Bureautique',
        'skills'  => [
          ['📝', 'Word / Excel'], ['🔤', 'Anglais'], ['💻', 'Git'],
        ],
      ],
    ];

    foreach ($categories as $cat) : ?>
      <div class="reveal" style="margin-bottom: 3rem;">
        <h3 style="font-size: 1rem; color: var(--primary); font-family: 'Space Mono', monospace; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1.5rem;">
          <i class="<?= $cat['icone'] ?>"></i> &nbsp;<?= $cat['titre'] ?>
        </h3>
        <div class="skills-grid">
          <?php foreach ($cat['skills'] as $skill) : ?>
            <div class="skill-card">
              <span class="skill-icon"><?= $skill[0] ?></span>
              <span class="skill-name"><?= $skill[1] ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

  </section>
</main>

<?php require '../composants/pied-de-page.php'; ?>
</body>
</html>
