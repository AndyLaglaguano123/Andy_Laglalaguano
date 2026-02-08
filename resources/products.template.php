   <?php require __DIR__ . '/partials/header.php'; ?>

   <div class="border-b border-gray-200 pb-8 mb-8">
      <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Productos</h2>
      <p class="text-lg text-gray-600 w-full max-w-4xl">
         Gestión de productos en el sistema.
      </p>
      <a href="/products/create" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Crear Nuevo Producto</a>
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

   <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
         <thead class="bg-gray-50">
            <tr>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
               <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
         </thead>
         <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($products as $product): ?>
               <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($product['id']) ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($product['name']) ?></td>
                  <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($product['description'] ?? '') ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$<?= htmlspecialchars($product['price']) ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($product['sku']) ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                     <a href="/products/edit?id=<?= $product['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>
                     <form method="POST" action="/products/destroy" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                     </form>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>

   <?php require __DIR__ . '/partials/footer.php'; ?>