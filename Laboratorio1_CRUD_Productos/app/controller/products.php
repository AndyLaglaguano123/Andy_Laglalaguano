<?php
$title = "Productos";

// Incluir Database
require_once __DIR__ . '/../../framework/Database.php';
$db = new Database();

// Iniciar sesión una vez al inicio
session_start();

// Función simple para validación
function validate($data, $rules) {
    $errors = [];
    foreach ($rules as $field => $rule) {
        $ruleParts = explode('|', $rule);
        foreach ($ruleParts as $part) {
            if ($part === 'required' && empty($data[$field])) {
                $errors[] = "El campo $field es requerido.";
            } elseif (strpos($part, 'min:') === 0) {
                $min = substr($part, 4);
                if (strlen($data[$field]) < $min) {
                    $errors[] = "El campo $field debe tener al menos $min caracteres.";
                }
            } elseif (strpos($part, 'max:') === 0) {
                $max = substr($part, 4);
                if (strlen($data[$field]) > $max) {
                    $errors[] = "El campo $field no debe exceder $max caracteres.";
                }
            } elseif ($part === 'numeric' && !is_numeric($data[$field])) {
                $errors[] = "El campo $field debe ser numérico.";
            }
        }
    }
    return $errors;
}

// Función para flash messages
function flash($key, $message) {
    $_SESSION[$key] = $message;
}

function getFlash($key) {
    $msg = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
    return $msg;
}

// Función para redirect
function redirect($url) {
    header("Location: $url");
    exit;
}

// Determinar acción basada en URI y método
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/products' && $method === 'GET') {
    // Index
    $products = $db->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    require __DIR__ . '/../../resources/products.template.php';
} elseif ($uri === '/products/create' && $method === 'GET') {
    // Create form
    require __DIR__ . '/../../resources/products-create.template.php';
} elseif ($uri === '/products/store' && $method === 'POST') {
    // Store
    $errors = validate($_POST, [
        'name' => 'required|min:3|max:255',
        'price' => 'required|numeric',
        'sku' => 'required|min:3|max:100',
    ]);
    if ($errors) {
        // Mostrar errores, por simplicidad, redirigir con error
        flash('error', implode('<br>', $errors));
        redirect('/products/create');
    } else {
        try {
            $db->query("INSERT INTO products(name, description, price, sku) VALUES(:name, :description, :price, :sku)", [
                'name' => $_POST['name'],
                'description' => $_POST['description'] ?? null,
                'price' => $_POST['price'],
                'sku' => $_POST['sku'],
            ]);
            flash('alert', 'Producto creado correctamente.');
            redirect('/products');
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                flash('error', 'El SKU ya existe. Por favor, elige uno único.');
            } else {
                flash('error', 'Error al crear el producto: ' . $e->getMessage());
            }
            redirect('/products/create');
        }
    }
} elseif (strpos($uri, '/products/edit') === 0 && $method === 'GET') {
    // Edit form
    $id = $_GET['id'] ?? null;
    if (!$id) {
        http_response_code(404);
        echo "ID requerido";
        exit;
    }
    $product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        http_response_code(404);
        echo "Producto no encontrado";
        exit;
    }
    require __DIR__ . '/../../resources/products-edit.template.php';
} elseif ($uri === '/products/update' && $method === 'POST') {
    // Update
    $errors = validate($_POST, [
        'id' => 'required|numeric',
        'name' => 'required|min:3|max:255',
        'price' => 'required|numeric',
        'sku' => 'required|min:3|max:100',
    ]);
    if ($errors) {
        flash('error', implode('<br>', $errors));
        redirect('/products/edit?id=' . $_POST['id']);
    } else {
        try {
            $db->query("UPDATE products SET name = :name, description = :description, price = :price, sku = :sku WHERE id = :id", [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'] ?? null,
                'price' => $_POST['price'],
                'sku' => $_POST['sku'],
            ]);
            flash('alert', 'Producto actualizado correctamente.');
            redirect('/products');
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                flash('error', 'El SKU ya existe. Por favor, elige uno único.');
            } else {
                flash('error', 'Error al actualizar el producto: ' . $e->getMessage());
            }
            redirect('/products/edit?id=' . $_POST['id']);
        }
    }
} elseif ($uri === '/products/destroy' && $method === 'POST') {
    // Destroy
    $id = $_POST['id'] ?? null;
    if (!$id) {
        flash('error', 'ID requerido');
        redirect('/products');
    }
    $db->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
    flash('alert', 'Producto eliminado correctamente.');
    redirect('/products');
} else {
    http_response_code(404);
    echo "Página no encontrada";
}
