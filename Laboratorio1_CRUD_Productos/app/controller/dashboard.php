<?php

$title = "Dashboard";

require_once __DIR__ . '/../../framework/Database.php';
require_once __DIR__ . '/../../framework/helpers.php';

$db = new Database();

try {
    $links = $db->query("SELECT * FROM links")->fetchAll(PDO::FETCH_ASSOC);
    $users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $links = [];
    $users = [];
    $error = "Error al obtener datos: " . $e->getMessage();
}

$stats = calculate_dashboard_stats($links, $users);

require __DIR__ . '/../../resources/dashboard.template.php';
