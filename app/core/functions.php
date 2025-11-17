<?php
// app/core/functions.php
// Fonctions utilitaires globales utilisées partout dans le projet
// Chargées une seule fois dans public/index.php

use App\Core\Database;

/**
 * Échappement HTML sécurisé (protège contre les attaques XSS)
 * Usage : echo e($user_input);
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Redirection simple et propre
 */
function redirect(string $url): never
{
    header("Location: $url");
    exit;
}

/**
 * Vérifie si un utilisateur est connecté
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

/**
 * Génère un token CSRF unique par session
 */
function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie la validité d'un token CSRF (protection contre les attaques CSRF)
 */
function verifyCsrfToken(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Messages flash (affichage unique après redirection)
 */
function flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function getFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Vérifie que l'utilisateur connecté est propriétaire de la ressource
 */
function requireOwnership(int $resourceUserId): void
{
    if (!isLoggedIn() || $_SESSION['user_id'] !== $resourceUserId) {
        flash("Accès refusé.", "danger");
        redirect('/books');
    }
}