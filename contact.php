<?php
require '../fonctions.php';

// ─── FORMULAIRE DE CONTACT ────────────────────────────────────────────────────
$erreurs_contact  = [];
$succes_contact   = false;
$c_nom     = '';
$c_prenom  = '';
$c_email   = '';
$c_sujet   = '';
$c_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formulaire']) && $_POST['formulaire'] === 'contact') {
    // Récupération et nettoyage des valeurs
    $c_nom     = nettoyer($_POST['nom']     ?? '');
    $c_prenom  = nettoyer($_POST['prenom']  ?? '');
    $c_email   = nettoyer($_POST['email']   ?? '');
    $c_sujet   = nettoyer($_POST['sujet']   ?? '');
    $c_message = nettoyer($_POST['message'] ?? '');

    // Validation des champs obligatoires
    if (!champ_requis($c_nom))     $erreurs_contact[] = 'Le nom est obligatoire.';
    if (!champ_requis($c_prenom))  $erreurs_contact[] = 'Le prénom est obligatoire.';
    if (!email_valide($c_email))   $erreurs_contact[] = 'L\'adresse e-mail est invalide.';
    if (!champ_requis($c_sujet))   $erreurs_contact[] = 'Le sujet est obligatoire.';
    if (!champ_requis($c_message)) $erreurs_contact[] = 'Le message ne peut pas être vide.';

    if (empty($erreurs_contact)) {
        $succes_contact = true;
        // Réinitialise les champs après succès
        $c_nom = $c_prenom = $c_email = $c_sujet = $c_message = '';
    }
}

// ─── FORMULAIRE DE DEMANDE DE PROJET ─────────────────────────────────────────
$erreurs_demande = [];
$succes_demande  = false;
$demande         = [];
$d_nom           = '';
$d_email         = '';
$d_type_projet   = '';
$d_description   = '';
$d_budget        = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formulaire']) && $_POST['formulaire'] === 'demande') {
    $d_nom          = nettoyer($_POST['nom']          ?? '');
    $d_email        = nettoyer($_POST['email']        ?? '');
    $d_type_projet  = nettoyer($_POST['type_projet']  ?? '');
    $d_description  = nettoyer($_POST['description']  ?? '');
    $d_budget       = nettoyer($_POST['budget']       ?? '');

    if (!champ_requis($d_nom))         $erreurs_demande[] = 'Le nom est obligatoire.';
    if (!email_valide($d_email))       $erreurs_demande[] = 'L\'adresse e-mail est invalide.';
    if (!champ_requis($d_type_projet)) $erreurs_demande[] = 'Le type de projet est obligatoire.';
    if (!champ_requis($d_description)) $erreurs_demande[] = 'La description est obligatoire.';

    if (empty($erreurs_demande)) {
        // Stocke la demande dans un tableau associatif
        $demande = [
            'nom'         => $d_nom,
            'email'       => $d_email,
            'type_projet' => $d_type_projet,
            'description' => $d_description,
            'budget'      => $d_budget,
        ];
        $succes_demande = true;
        $d_nom = $d_email = $d_type_projet = $d_description = $d_budget = '';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact — Mahamat Dillo</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .erreur-liste {
      background: rgba(255, 107, 107, 0.1);
      border: 1px solid var(--accent);
      border-radius: 10px;
      padding: 1rem 1.25rem;
      margin-bottom: 1.25rem;
      color: var(--accent);
      font-size: 0.88rem;
    }
    .erreur-liste ul { margin: 0.4rem 0 0 1.2rem; padding: 0; }
    .erreur-liste li { margin-bottom: 0.2rem; }
    .succes-box {
      background: rgba(0, 201, 167, 0.1);
      border: 1px solid var(--primary);
      border-radius: 10px;
      padding: 1.25rem;
      text-align: center;
      color: var(--primary);
      font-size: 0.95rem;
      margin-bottom: 1.25rem;
    }
    .recap-box {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      margin-top: 1rem;
    }
    .recap-box h4 {
      font-size: 0.9rem;
      color: var(--primary);
      font-family: 'Space Mono', monospace;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 1rem;
    }
    .recap-row {
      display: flex;
      gap: 1rem;
      margin-bottom: 0.6rem;
      font-size: 0.88rem;
    }
    .recap-row .label {
      color: var(--muted);
      min-width: 120px;
      font-weight: 600;
    }
    .recap-row .valeur { color: var(--text); }
    .tabs {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 2rem;
      border-bottom: 1px solid var(--border);
    }
    .tab-btn {
      padding: 0.75rem 1.5rem;
      background: none;
      border: none;
      color: var(--muted);
      font-size: 0.9rem;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      margin-bottom: -1px;
      transition: all 0.2s;
      font-family: inherit;
    }
    .tab-btn.active {
      color: var(--primary);
      border-bottom-color: var(--primary);
    }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
  </style>
</head>
<body>

<?php require '../composants/navigation.php'; ?>

<main class="page">
  <section>
    <div class="section-label reveal">Restons en contact</div>
    <h2 class="section-title reveal">Me Contacter</h2>
    <div class="section-divider reveal"></div>

    <div class="contact-grid">
      <!-- INFOS CONTACT -->
      <div>
        <div class="contact-info reveal">
          <h3>Parlons de votre projet</h3>
          <p>
            Vous avez une question, une idée ou un projet à réaliser ?
            N'hésitez pas à m'écrire. Je réponds généralement dans les 24h.
          </p>
        </div>

        <div class="contact-socials reveal">
          <a href="https://www.facebook.com/profile.php?id=100080874432473" target="_blank" class="social-link">
            <span class="social-icon"><i class="fab fa-facebook"></i></span>
            <span>Facebook — Mahamat Dillo</span>
          </a>
          <a href="https://www.instagram.com/bavaroiscriminos/" target="_blank" class="social-link">
            <span class="social-icon"><i class="fab fa-instagram"></i></span>
            <span>Instagram — @bavaroiscriminos</span>
          </a>
          <a href="mailto:bavbavarois@gmail.com" class="social-link">
            <span class="social-icon"><i class="fas fa-envelope"></i></span>
            <span>Gmail — bavbavarois@gmail.com</span>
          </a>
        </div>

        <div class="reveal" style="margin-top: 2rem; background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem;">
          <div style="font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--primary); margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.1em;">
            📍 Localisation
          </div>
          <div style="color: var(--text); font-size: 0.95rem; font-weight: 600;">Dakar, Sénégal</div>
          <div style="color: var(--muted); font-size: 0.8rem; margin-top: 0.3rem;">ESTM — École Supérieure de Technologie et de Management</div>
        </div>
      </div>

      <!-- FORMULAIRES AVEC ONGLETS -->
      <div class="reveal">
        <div class="tabs">
          <button class="tab-btn active" onclick="ouvrirOnglet(event, 'tab-contact')">
            <i class="fas fa-envelope"></i> Message
          </button>
          <button class="tab-btn" onclick="ouvrirOnglet(event, 'tab-demande')">
            <i class="fas fa-briefcase"></i> Demande de projet
          </button>
        </div>

        <!-- ONGLET 1 : FORMULAIRE DE CONTACT -->
        <div id="tab-contact" class="tab-content active">
          <?php if ($succes_contact) : ?>
            <div class="succes-box">
              ✅ Message envoyé avec succès ! Merci <?= nettoyer($c_nom) ?>, je vous répondrai dans les 24h.
            </div>
          <?php endif; ?>

          <?php if (!empty($erreurs_contact)) : ?>
            <div class="erreur-liste">
              <strong>⚠️ Veuillez corriger les erreurs suivantes :</strong>
              <ul>
                <?php foreach ($erreurs_contact as $err) : ?>
                  <li><?= nettoyer($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" action="contact.php" style="background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 2rem;">
            <input type="hidden" name="formulaire" value="contact">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Envoyer un message</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <div class="form-group">
                <label for="c-nom">Nom *</label>
                <input type="text" id="c-nom" name="nom"
                  placeholder="Votre nom"
                  value="<?= nettoyer($c_nom) ?>"
                  required>
              </div>
              <div class="form-group">
                <label for="c-prenom">Prénom *</label>
                <input type="text" id="c-prenom" name="prenom"
                  placeholder="Votre prénom"
                  value="<?= nettoyer($c_prenom) ?>"
                  required>
              </div>
            </div>
            <div class="form-group">
              <label for="c-email">Email *</label>
              <input type="email" id="c-email" name="email"
                placeholder="exemple@gmail.com"
                value="<?= nettoyer($c_email) ?>"
                required>
            </div>
            <div class="form-group">
              <label for="c-sujet">Sujet *</label>
              <input type="text" id="c-sujet" name="sujet"
                placeholder="Objet de votre message"
                value="<?= nettoyer($c_sujet) ?>"
                required>
            </div>
            <div class="form-group">
              <label for="c-message">Message *</label>
              <textarea id="c-message" name="message"
                placeholder="Votre message..."
                required
                style="height: 140px;"><?= nettoyer($c_message) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
              <i class="fas fa-paper-plane"></i> Envoyer le message
            </button>
          </form>
        </div>

        <!-- ONGLET 2 : FORMULAIRE DE DEMANDE DE PROJET -->
        <div id="tab-demande" class="tab-content">
          <?php if ($succes_demande) : ?>
            <div class="succes-box">
              ✅ Demande envoyée ! Merci <?= nettoyer($demande['nom']) ?>, je vous contacterai bientôt.
            </div>
            <!-- RÉCAPITULATIF DE LA DEMANDE -->
            <div class="recap-box">
              <h4>📋 Récapitulatif de votre demande</h4>
              <div class="recap-row">
                <span class="label">Nom :</span>
                <span class="valeur"><?= nettoyer($demande['nom']) ?></span>
              </div>
              <div class="recap-row">
                <span class="label">Email :</span>
                <span class="valeur"><?= nettoyer($demande['email']) ?></span>
              </div>
              <div class="recap-row">
                <span class="label">Type de projet :</span>
                <span class="valeur"><?= nettoyer($demande['type_projet']) ?></span>
              </div>
              <div class="recap-row">
                <span class="label">Description :</span>
                <span class="valeur"><?= nettoyer($demande['description']) ?></span>
              </div>
              <?php if (champ_requis($demande['budget'])) : ?>
              <div class="recap-row">
                <span class="label">Budget estimé :</span>
                <span class="valeur"><?= nettoyer($demande['budget']) ?></span>
              </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($erreurs_demande)) : ?>
            <div class="erreur-liste">
              <strong>⚠️ Veuillez corriger les erreurs suivantes :</strong>
              <ul>
                <?php foreach ($erreurs_demande as $err) : ?>
                  <li><?= nettoyer($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" action="contact.php#tab-demande" style="background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 2rem;">
            <input type="hidden" name="formulaire" value="demande">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Soumettre une demande de projet</h3>
            <div class="form-group">
              <label for="d-nom">Votre nom *</label>
              <input type="text" id="d-nom" name="nom"
                placeholder="Votre nom complet"
                value="<?= nettoyer($d_nom) ?>"
                required>
            </div>
            <div class="form-group">
              <label for="d-email">Email *</label>
              <input type="email" id="d-email" name="email"
                placeholder="exemple@gmail.com"
                value="<?= nettoyer($d_email) ?>"
                required>
            </div>
            <div class="form-group">
              <label for="d-type">Type de projet *</label>
              <select id="d-type" name="type_projet" required style="width:100%; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: 10px; background: var(--bg); color: var(--text); font-size: 0.9rem;">
                <option value="">-- Choisissez un type --</option>
                <?php
                $types = ['Site web vitrine', 'Application web', 'Portfolio', 'E-commerce', 'Projet IoT / Embarqué', 'Réseau & Infrastructure', 'Autre'];
                foreach ($types as $type) : ?>
                  <option value="<?= nettoyer($type) ?>" <?= ($d_type_projet === $type) ? 'selected' : '' ?>>
                    <?= nettoyer($type) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="d-desc">Description du projet *</label>
              <textarea id="d-desc" name="description"
                placeholder="Décrivez votre projet en quelques lignes..."
                required
                style="height: 120px;"><?= nettoyer($d_description) ?></textarea>
            </div>
            <div class="form-group">
              <label for="d-budget">Budget estimé (optionnel)</label>
              <input type="text" id="d-budget" name="budget"
                placeholder="Ex : 50 000 FCFA, À discuter..."
                value="<?= nettoyer($d_budget) ?>">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
              <i class="fas fa-briefcase"></i> Envoyer la demande
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require '../composants/pied-de-page.php'; ?>

<script>
  function ouvrirOnglet(e, id) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    e.currentTarget.classList.add('active');
  }

  // Si on revient sur la page après une demande de projet, ouvrir le bon onglet
  <?php if ($succes_demande || !empty($erreurs_demande)) : ?>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-demande').classList.add('active');
    document.querySelectorAll('.tab-btn')[1].classList.add('active');
  });
  <?php endif; ?>
</script>
</body>
</html>
