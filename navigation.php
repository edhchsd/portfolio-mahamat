<?php
// Récupère le nom du fichier actuellement chargé pour gérer le lien actif
$page_courante = basename($_SERVER['PHP_SELF']);

// Détermine le chemin de base selon si on est à la racine ou dans /pages/
$est_dans_pages = (dirname($_SERVER['PHP_SELF']) !== '/' && strpos($_SERVER['PHP_SELF'], '/pages/') !== false);
$base = $est_dans_pages ? '../' : '';
?>
<nav>
  <a href="<?= $base ?>index.php" class="nav-brand">
    <img src="<?= $base ?>images/mo.jpeg" alt="Mahamat Dillo" class="nav-avatar">
    <span class="nav-name">@bavarois</span>
  </a>
  <ul class="nav-links" id="navLinks">
    <li>
      <a href="<?= $base ?>index.php"
        <?php if ($page_courante === 'index.php') echo 'class="active"'; ?>>
        Accueil
      </a>
    </li>
    <li>
      <a href="<?= $base ?>pages/apropos.php"
        <?php if ($page_courante === 'apropos.php') echo 'class="active"'; ?>>
        À propos
      </a>
    </li>
    <li>
      <a href="<?= $base ?>pages/competences.php"
        <?php if ($page_courante === 'competences.php') echo 'class="active"'; ?>>
        Compétences
      </a>
    </li>
    <li>
      <a href="<?= $base ?>pages/projets.php"
        <?php if ($page_courante === 'projets.php') echo 'class="active"'; ?>>
        Projets
      </a>
    </li>
    <li>
      <a href="<?= $base ?>pages/contact.php"
        <?php if ($page_courante === 'contact.php') echo 'class="active"'; ?>>
        Contact
      </a>
    </li>
  </ul>
  <button class="hamburger" onclick="document.getElementById('navLinks').classList.toggle('open')" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>
