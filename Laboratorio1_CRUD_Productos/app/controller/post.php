<?php
$title = "Posts";

// Definición del arreglo asociativo $post que representa un artículo de blog.
// Contiene título, autor, fecha, contenido (con al menos 50 palabras) y tags (al menos 4).
$post = [
    'titulo' => 'El Poder de PHP en el Desarrollo Web Moderno',
    'autor' => 'Ana García',
    'fecha' => '2026-03-15',
    'contenido' => 'PHP ha sido durante mucho tiempo un pilar del desarrollo web, ofreciendo una sintaxis sencilla y poderosa que permite crear aplicaciones dinámicas con facilidad. Desde sus inicios en 1994, ha evolucionado para convertirse en una herramienta esencial para backend, soportando frameworks como Laravel y Symfony. Su integración con bases de datos como MySQL facilita la gestión de datos, mientras que su capacidad para manejar sesiones y cookies mejora la experiencia del usuario. Además, PHP es gratuito y de código abierto, lo que lo hace accesible para desarrolladores de todos los niveles. En un mundo donde la velocidad y la escalabilidad son clave, PHP continúa adaptándose con versiones modernas que incluyen mejoras en rendimiento y seguridad. Esta versatilidad lo posiciona como una opción ideal para proyectos web de cualquier tamaño, desde sitios simples hasta aplicaciones empresariales complejas. En resumen, dominar PHP abre puertas a oportunidades ilimitadas en el desarrollo web.',
    'tags' => ['PHP', 'Backend', 'Servidores', 'Desarrollo Web']
];

// Función para formatear la información del autor.
// Recibe el arreglo $post y devuelve un string con el formato "Publicado por [autor] el [fecha]".
function formatear_info_autor(array $postData): string {
    return "Publicado por " . htmlspecialchars($postData['autor']) . " el " . htmlspecialchars($postData['fecha']);
}

// Función para renderizar las etiquetas en HTML.
// Recibe el arreglo de tags y devuelve un string con cada tag envuelto en <span class='tag'>.
// Se agrega un espacio entre cada tag para evitar que se peguen.
function renderizar_tags_html(array $tags): string {
    $html = '';
    foreach ($tags as $tag) {
        $html .= "<span class='tag'>" . htmlspecialchars($tag) . "</span> ";
    }
    return trim($html); // Trim para eliminar el espacio final si es necesario
}

// Función para contar palabras en un texto.
// Recibe un string y devuelve el número de palabras.
function contar_palabras(string $texto): int {
    return str_word_count($texto);
}

require __DIR__ . '/../../resources/post.template.php';

