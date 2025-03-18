<?php
// Get current page name for active state
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar -->
<div class="sidebar fixed md:relative w-64 h-screen bg-gray-800 text-white shadow-lg md:translate-x-0">
    <div class="h-full flex flex-col">
        <!-- Logo Section -->
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center justify-center">
                <!-- Placeholder for ITEVO logo -->
                <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-boxes text-2xl"></i>
                </div>
                <span class="text-xl font-bold">Inventario</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-2 px-3">
                <!-- Dashboard -->
                <li>
                    <a href="index.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'index.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Inventory Management Section -->
                <li class="pt-4">
                    <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Gestión de Inventario
                    </div>
                </li>

                <!-- Products -->
                <li>
                    <a href="productos.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'productos.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Productos</span>
                    </a>
                </li>

                <!-- Categories -->
                <li>
                    <a href="categorias.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'categorias.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-tags w-5 h-5 mr-3"></i>
                        <span>Categorías</span>
                    </a>
                </li>

                <!-- Warehouse Operations Section -->
                <li class="pt-4">
                    <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Operaciones de Almacén
                    </div>
                </li>

                <!-- Transfers -->
                <li>
                    <a href="transferencias.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'transferencias.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-exchange-alt w-5 h-5 mr-3"></i>
                        <span>Transferencias</span>
                    </a>
                </li>

                <!-- Reception -->
                <li>
                    <a href="recepcion.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'recepcion.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-truck-loading w-5 h-5 mr-3"></i>
                        <span>Recepción</span>
                    </a>
                </li>

                <!-- Returns -->
                <li>
                    <a href="devoluciones.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'devoluciones.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-undo-alt w-5 h-5 mr-3"></i>
                        <span>Devoluciones</span>
                    </a>
                </li>

                <!-- Sales Section -->
                <li class="pt-4">
                    <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Ventas y Clientes
                    </div>
                </li>

                <!-- Sales -->
                <li>
                    <a href="ventas.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'ventas.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                        <span>Ventas</span>
                    </a>
                </li>

                <!-- Clients -->
                <li>
                    <a href="clientes.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'clientes.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Clientes</span>
                    </a>
                </li>

                <!-- Associated Clients -->
                <li>
                    <a href="clientes_asociados.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'clientes_asociados.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-user-friends w-5 h-5 mr-3"></i>
                        <span>Clientes Asociados</span>
                    </a>
                </li>

                <!-- Financial Section -->
                <li class="pt-4">
                    <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Finanzas
                    </div>
                </li>

                <!-- Accounts Receivable -->
                <li>
                    <a href="cuentas_por_cobrar.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'cuentas_por_cobrar.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3"></i>
                        <span>Cuentas por Cobrar</span>
                    </a>
                </li>

                <!-- Accounts Payable -->
                <li>
                    <a href="cuentas_por_pagar.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'cuentas_por_pagar.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-money-bill-wave w-5 h-5 mr-3"></i>
                        <span>Cuentas por Pagar</span>
                    </a>
                </li>

                <!-- System Section -->
                <li class="pt-4">
                    <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Sistema
                    </div>
                </li>

                <!-- Users -->
                <li>
                    <a href="usuarios.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'usuarios.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-user-cog w-5 h-5 mr-3"></i>
                        <span>Usuarios</span>
                    </a>
                </li>

                <!-- Cancellations -->
                <li>
                    <a href="cancelaciones.php" class="flex items-center px-4 py-2 rounded-lg <?php echo $currentPage == 'cancelaciones.php' ? 'bg-blue-600' : 'hover:bg-gray-700'; ?>">
                        <i class="fas fa-ban w-5 h-5 mr-3"></i>
                        <span>Cancelaciones</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- User Section -->
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center">
                <i class="fas fa-user-circle text-2xl mr-3"></i>
                <div>
                    <p class="text-sm font-medium"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Usuario'; ?></p>
                    <a href="logout.php" class="text-sm text-gray-400 hover:text-white">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Sidebar toggle functionality for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    }
</script>