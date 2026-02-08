   <?php require __DIR__ . '/partials/header.php'; ?>

   <style>
      .tag {
         display: inline-block;
         background-color: #dbeafe;
         color: #1e40af;
         padding: 0.25rem 0.5rem;
         border-radius: 0.25rem;
         margin-right: 0.5rem;
         font-size: 0.875rem;
      }
   </style>

   <div class="border-b border-gray-200 pb-8 mb-8">
      <h1 class="text-4xl font-semibold text-gray-900 sm:text-5xl">
         <?= htmlspecialchars($post['titulo']); ?>
      </h1>

      <p class="text-lg text-gray-600 mt-4">
         <?= formatear_info_autor($post); ?>
      </p>
   </div>

   <div class="prose prose-lg max-w-none">
      <p class="text-gray-700 leading-relaxed">
         <?= htmlspecialchars($post['contenido']); ?>
      </p>
   </div>

   <div class="mt-8 border-t border-gray-200 pt-8">
      <p class="text-sm text-gray-600">
         Número de palabras: <?= contar_palabras($post['contenido']); ?>
      </p>

      <div class="mt-4">
         <?= renderizar_tags_html($post['tags']); ?>
      </div>
   </div>

   <?php require __DIR__ . '/partials/footer.php'; ?>