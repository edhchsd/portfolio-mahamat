<?php require '../fonctions.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À propos — Mahamat Dillo</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require '../composants/navigation.php'; ?>

<main class="page">
  <section>
    <div class="section-label reveal">Qui suis-je</div>
    <h2 class="section-title reveal">À Propos de Moi</h2>
    <div class="section-divider reveal"></div>

    <div class="about-grid">
      <div class="about-text">
        <p class="reveal">
          Je suis <strong style="color: var(--primary)">Mahamat Dillo Berkou</strong>, étudiant en 2ème année à
          l'<strong>ESTM de Dakar</strong> (École Supérieure de Technologie et de Management),
          en double filière Génie Logiciel et Administration Réseaux.
        </p>
        <p class="reveal">
          Ma passion pour l'informatique m'a conduit à explorer plusieurs domaines :
          du développement web à l'électronique embarquée avec Arduino et ESP32,
          en passant par la configuration d'infrastructures réseau avec Cisco.
        </p>
        <p class="reveal">
          Je suis également intéressé par le commerce en ligne et la création de solutions
          e-commerce. Chaque projet que je réalise est une opportunité d'apprendre et de
          m'améliorer davantage.
        </p>
        <p class="reveal">
          En tant qu'informaticien en génie logiciel, je trouve une satisfaction immense dans
          l'art de créer des applications qui transforment des idées abstraites en expériences
          numériques concrètes.
        </p>
        <div style="margin-top: 2rem;" class="reveal">
          <a href="contact.php" class="btn btn-primary">
            <i class="fas fa-envelope"></i> Me contacter
          </a>
        </div>
      </div>
      <div class="reveal">
        <img src="../images/profile.jpg" alt="Mahamat Dillo" class="about-img">
        <div style="margin-top: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <?php
          $stats = [
            ['2ème', 'Année'], ['ESTM', 'Dakar'],
            ['4+', 'Projets'], ['8', 'Technologies'],
          ];
          foreach ($stats as $s) : ?>
            <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.2rem; text-align: center;">
              <div style="font-family: 'Space Mono', monospace; font-size: 1.5rem; color: var(--primary); font-weight: 700;"><?= $s[0] ?></div>
              <div style="font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em;"><?= $s[1] ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- FORMATION -->
  <section style="padding-top: 0;">
    <div class="section-label reveal">Mon parcours</div>
    <h2 class="section-title reveal">Formation</h2>
    <div class="section-divider reveal"></div>

    <div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 700px;">
      <div class="reveal" style="display: flex; gap: 1.5rem; align-items: flex-start;">
        <div style="min-width: 50px; height: 50px; background: rgba(0,201,167,0.1); border: 2px solid var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">🎓</div>
        <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; flex: 1;">
          <div style="font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--primary); margin-bottom: 0.3rem;">2023 — Présent</div>
          <h3 style="font-size: 1rem; margin-bottom: 0.3rem;">Génie Logiciel &amp; Administration Réseaux</h3>
          <div style="color: var(--muted); font-size: 0.85rem;">ESTM — École Supérieure de Technologie et de Management, Dakar</div>
        </div>
      </div>
      <div class="reveal" style="display: flex; gap: 1.5rem; align-items: flex-start;">
        <div style="min-width: 50px; height: 50px; background: rgba(255,107,107,0.1); border: 2px solid var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">📜</div>
        <div style="background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; flex: 1;">
          <div style="font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--accent); margin-bottom: 0.3rem;">2021</div>
          <h3 style="font-size: 1rem; margin-bottom: 0.3rem;">Formation Bureautique &amp; Anglais</h3>
          <div style="color: var(--muted); font-size: 0.85rem;">Formation certifiante enrichissant le parcours professionnel en informatique</div>
          <div style="margin-top: 1rem; display: flex; gap: 0.5rem;">
            <img src="../images/tt.jpg" alt="Attestation" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
            <img src="../images/ss.jpg" alt="Attestation" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require '../composants/pied-de-page.php'; ?>
</body>
</html>
