<?php require __DIR__ . '/partials/header.php'; ?>

<div class="border-b border-gray-200 pb-8 mb-8">
   <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Editar enlace</h2>
</div>

<?php if ($err = getFlash('error')): ?>
   <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?= $err ?></div>
<?php endif; ?>

<form method="POST" action="/links/update" class="space-y-4 max-w-xl">
   <input type="hidden" name="id" value="<?= htmlspecialchars($link['id']) ?>">
   <div>
      <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
      <input type="url" name="url" id="url" required value="<?= htmlspecialchars($link['url']) ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
   </div>
   <div>
      <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
      <input type="text" name="title" id="title" required value="<?= htmlspecialchars($link['title']) ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
   </div>
   <div>
      <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
      <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?= htmlspecialchars($link['description'] ?? '') ?></textarea>
   </div>
   <div>
      <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
      <input type="text" name="category" id="category" value="<?= htmlspecialchars($link['category'] ?? '') ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
   </div>
   <div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar cambios</button>
      <a href="/links" class="ml-4 text-sm text-gray-600">Cancelar</a>
   </div>
</form>

<?php require __DIR__ . '/partials/footer.php'; ?>
