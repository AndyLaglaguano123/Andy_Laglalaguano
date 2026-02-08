<?php
$title = "Proyectos";

require_once __DIR__ . '/../../framework/Database.php';

// Simple flash helpers
session_start();
function flash($key, $message) {
    $_SESSION[$key] = $message;
}
function getFlash($key) {
    $msg = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
    return $msg;
}
function redirect($url) {
    header("Location: $url");
    exit;
}

$db = new Database();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Helper to check if a column exists in a table
function columnExists($db, $table, $column)
{
    $stmt = $db->query("SHOW COLUMNS FROM {$table} LIKE :col", [':col' => $column]);
    return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($uri === '/links' && $method === 'GET') {
    $links = $db->query("SELECT * FROM links ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    require __DIR__ . '/../../resources/links.template.php';
} elseif ($uri === '/links/create' && $method === 'GET') {
    require __DIR__ . '/../../resources/links-create.template.php';
} elseif ($uri === '/links/edit' && $method === 'GET') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        http_response_code(404);
        echo "ID requerido";
        exit;
    }
    $link = $db->query("SELECT * FROM links WHERE id = :id", ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    if (!$link) {
        http_response_code(404);
        echo "Enlace no encontrado";
        exit;
    }
    require __DIR__ . '/../../resources/links-edit.template.php';
} elseif ($uri === '/links/store' && $method === 'POST') {
    $url = trim($_POST['url'] ?? '');
    $titleField = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? null);
    $category = trim($_POST['category'] ?? null);

    if (empty($url) || empty($titleField)) {
        flash('error', 'URL y título son requeridos.');
        redirect('/links/create');
    }

    // Build query depending on whether 'category' column exists
    if (columnExists($db, 'links', 'category')) {
        $sql = "INSERT INTO links (url, title, description, category) VALUES (:url, :title, :description, :category)";
        $params = [
            'url' => $url,
            'title' => $titleField,
            'description' => $description,
            'category' => $category,
        ];
    } else {
        $sql = "INSERT INTO links (url, title, description) VALUES (:url, :title, :description)";
        $params = [
            'url' => $url,
            'title' => $titleField,
            'description' => $description,
        ];
    }

    $db->query($sql, $params);
    flash('alert', 'Link creado correctamente.');
    redirect('/links');
} elseif ($uri === '/links/destroy' && $method === 'POST') {
    $id = $_POST['id'] ?? null;
    if (!$id) {
        flash('error', 'ID requerido');
        redirect('/links');
    }
    $db->query("DELETE FROM links WHERE id = :id", ['id' => $id]);
    flash('alert', 'Link eliminado correctamente.');
    redirect('/links');
} else {
    http_response_code(404);
    echo "Página no encontrada";
}

// Update handler
if ($uri === '/links/update' && $method === 'POST') {
    $id = $_POST['id'] ?? null;
    $url = trim($_POST['url'] ?? '');
    $titleField = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? null);
    $category = trim($_POST['category'] ?? null);

    if (!$id || empty($url) || empty($titleField)) {
        flash('error', 'ID, URL y título son requeridos.');
        redirect('/links');
    }

    // Build update depending on whether 'category' column exists
    if (columnExists($db, 'links', 'category')) {
        $sql = "UPDATE links SET url = :url, title = :title, description = :description, category = :category WHERE id = :id";
        $params = [
            'url' => $url,
            'title' => $titleField,
            'description' => $description,
            'category' => $category,
            'id' => $id,
        ];
    } else {
        $sql = "UPDATE links SET url = :url, title = :title, description = :description WHERE id = :id";
        $params = [
            'url' => $url,
            'title' => $titleField,
            'description' => $description,
            'id' => $id,
        ];
    }

    $db->query($sql, $params);
    flash('alert', 'Link actualizado correctamente.');
    redirect('/links');
}
