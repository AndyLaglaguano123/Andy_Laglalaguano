<?php require __DIR__ . '/partials/header.php'; ?>

<div class="mt-10">
    <h1 class="text-4xl font-bold mb-6 text-gray-800">Dashboard de Estadísticas</h1>
    <hr class="mb-8">

    <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Tarjeta 1: Total de Links -->
        <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Total de Links</h2>
            <h3 class="text-5xl font-bold mb-2">
                <?php echo $stats['total_links']; ?>
            </h3>
            <p class="text-blue-100">Links registrados en el sistema.</p>
        </div>

        <!-- Tarjeta 2: Total de Usuarios -->
        <div class="bg-green-500 text-white rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Total de Usuarios</h2>
            <h3 class="text-5xl font-bold mb-2">
                <?php echo $stats['total_users']; ?>
            </h3>
            <p class="text-green-100">Usuarios registrados en la plataforma.</p>
        </div>

        <!-- Tarjeta 3: Último Usuario -->
        <div class="bg-gray-100 text-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Último Usuario Registrado</h2>
            <h3 class="text-2xl font-bold mb-2">
                <?php echo htmlspecialchars($stats['last_user_email']); ?>
            </h3>
            <p class="text-gray-600">Email del usuario más reciente.</p>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
