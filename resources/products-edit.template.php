   <?php require __DIR__ . '/partials/header.php'; ?>

   <div class="border-b border-gray-200 pb-8 mb-8">
      <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Editar Producto</h2>
   </div>

   <?php if ($alert = getFlash('alert')): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
         <?= $alert ?>
      </div>
   <?php endif; ?>

   <?php if ($error = getFlash('error')): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
         <?= $error ?>
      </div>
   <?php endif; ?>

   <form method="POST" action="/products/update" class="space-y-4">
      <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
      <div>
         <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
         <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
         <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
         <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
      </div>
      <div>
         <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
         <input type="number" step="0.01" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>
      <div>
         <label for="sku" class="block text-sm font-medium text-gray-700">Código Único del Producto</label>
         <input type="text" name="sku" id="sku" value="<?= htmlspecialchars($product['sku']) ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ej: PROD-001">
         <p class="text-xs text-gray-500 mt-1">Debe ser único para identificar el producto.</p>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar Producto</button>
   </form>

   <?php require __DIR__ . '/partials/footer.php'; ?>