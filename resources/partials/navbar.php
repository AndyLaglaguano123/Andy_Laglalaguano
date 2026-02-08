<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl flex h-16 items-center justify-center">
        <div class="flex gap-4">
            <a href="/" class="<?= $_SERVER['REQUEST_URI'] === '/' ?> bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Inicio</a>
            <a href="/post" class="<?= $_SERVER['REQUEST_URI'] === '/post' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Post</a>
            <a href="/about" class="<?= $_SERVER['REQUEST_URI'] === '/about' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Acerca de</a>
            <a href="/links" class="<?= $_SERVER['REQUEST_URI'] === '/links' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Proyectos</a>
            <a href="/dashboard" class="<?= $_SERVER['REQUEST_URI'] === '/dashboard' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
            <a href="/products" class="<?= $_SERVER['REQUEST_URI'] === '/products' || strpos($_SERVER['REQUEST_URI'], '/products') === 0 ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Productos</a>
        </div>
    </div>
</nav>