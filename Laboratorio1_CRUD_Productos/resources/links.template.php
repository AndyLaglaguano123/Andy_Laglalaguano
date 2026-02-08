<?php require __DIR__ . '/partials/header.php'; ?>

<div class="border-b border-gray-200 pb-4 mb-6 flex items-center justify-between">
   <div>
      <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Mis proyectos recientes</h2>
      <p class="text-lg text-gray-600 w-full max-w-4xl">Lista de enlaces guardados en la base de datos.</p>
   </div>
   <div>
      <a href="/links/create" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar enlace</a>
   </div>
</div>

<?php if ($msg = getFlash('alert')): ?>
   <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?= $msg ?></div>
<?php endif; ?>
<?php if ($err = getFlash('error')): ?>
   <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?= $err ?></div>
<?php endif; ?>

<div class="grid grid-cols-1 gap-6">
   <?php if (empty($links)): ?>
      <p class="text-gray-600">No hay enlaces registrados.</p>
   <?php else: ?>
      <?php foreach ($links as $link): ?>
         <div class="p-4 bg-white rounded shadow-sm flex justify-between items-start">
            <div>
               <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-blue-600 font-medium hover:underline"><?= htmlspecialchars($link['title'] ?: $link['url']) ?></a>
               <p class="text-sm text-gray-600"><?= htmlspecialchars($link['description'] ?? '') ?></p>
               <?php if (!empty($link['category'])): ?>
                  <p class="mt-2 text-xs text-gray-500">Categoría: <?= htmlspecialchars($link['category']) ?></p>
               <?php endif; ?>
            </div>
            <div class="ml-4 flex flex-col gap-2">
               <a href="/links/edit?id=<?= $link['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded text-center">Editar</a>
               <form method="POST" action="/links/destroy" onsubmit="return confirm('¿Eliminar este enlace?');">
                  <input type="hidden" name="id" value="<?= $link['id'] ?>">
                  <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Eliminar</button>
               </form>
            </div>
         </div>
      <?php endforeach; ?>
   <?php endif; ?>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>

   