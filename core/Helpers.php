<?php
// Helpers generales

if (!function_exists('is_logged_in')) {
    function is_logged_in(): bool {
        return isset($_SESSION['usuario']);
    }
}

if (!function_exists('current_user')) {
    function current_user(): ?array {
        return $_SESSION['usuario'] ?? null;
    }
}

if (!function_exists('has_role')) {
    function has_role(string $role): bool {
        return (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === $role);
    }
}

if (!function_exists('redirect_to')) {
    function redirect_to(string $url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }
}

if (!function_exists('dd')) {
    // Dump and die (para debug)
    function dd($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }
}
