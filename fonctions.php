<?php

/**
 * Nettoie une valeur pour l'afficher sans risque dans du HTML.
 * @param string $valeur  La valeur brute
 * @return string         La valeur nettoyée
 */
function nettoyer(string $valeur): string {
    return htmlspecialchars(trim($valeur));
}

/**
 * Vérifie qu'un champ n'est pas vide après nettoyage.
 * @param string $valeur  La valeur à vérifier
 * @return bool           true si le champ est valide, false sinon
 */
function champ_requis(string $valeur): bool {
    return !empty(trim($valeur));
}

/**
 * Vérifie qu'une adresse e-mail a un format valide.
 * @param string $email  L'adresse e-mail à vérifier
 * @return bool          true si l'e-mail est valide, false sinon
 */
function email_valide(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Retourne le tableau de tous les projets du portfolio.
 * @return array  Liste des projets sous forme de tableaux associatifs
 */
function get_projets(): array {
    return [
        [
            'id'           => 1,
            'titre'        => 'Système IoT ESP32',
            'description'  => 'Système connecté avec ESP32 : contrôle de LED, LCD, gestion de porte, bus retour et capteurs de température/humidité.',
            'technologies' => ['ESP32', 'IoT', 'Arduino'],
            'images'       => ['ar4.jpg', 'ar1.jpg', 'ar2.jpg', 'ar3.jpg'],
        ],
        [
            'id'           => 2,
            'titre'        => 'Développement Web',
            'description'  => 'Création de pages web complètes avec design responsive, structures sémantiques propres et optimisées pour tous les écrans. Utilisation de Flexbox et CSS Grid.',
            'technologies' => ['HTML', 'CSS', 'JavaScript'],
            'images'       => ['dev1.jpg', 'dev2.jpg', 'dev3.jpg', 'dev4.jpg'],
        ],
        [
            'id'           => 3,
            'titre'        => 'Configuration Réseau Statique',
            'description'  => 'Configuration complète d\'une architecture réseau avec adressage IP statique, routage entre sous-réseaux et simulation via Cisco Packet Tracer.',
            'technologies' => ['Cisco', 'Réseaux', 'Packet Tracer'],
            'images'       => ['ci1.jpg', 'ci2.jpg', 'ci3.jpg', 'ci4.jpg'],
        ],
        [
            'id'           => 4,
            'titre'        => 'Compétences en E-commerce',
            'description'  => 'Page d\'accueil avec catalogue de produits, fiche produit détaillée, système de panier, formulaire de commande avec validation et interface responsive.',
            'technologies' => ['HTML', 'CSS', 'JavaScript'],
            'images'       => ['e1.jpg', 'e2.jpg', 'e3.jpg', 'e4.jpg'],
        ],
        [
            'id'           => 5,
            'titre'        => 'Gestionnaire de Contenu Social Media',
            'description'  => 'Outils d\'optimisation pour créateurs de contenu TikTok et Facebook. Stratégie digitale et gestion de présence en ligne.',
            'technologies' => ['Stratégie Digitale', 'Social Media'],
            'images'       => [],
        ],
    ];
}
