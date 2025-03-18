<?php
require_once 'database.php';
checkSession();

// Definir constante para el footer
define('ITEVO', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Sistema de Inventario ITEVO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex flex-grow">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4">
                <h1 class="text-2xl font-bold">ITEVO</h1>
                <p class="text-gray-400">Sistema de Inventario</p>
            </div>
            
            <nav class="mt-8 space-y-2 px-4">
                <a href="index.php" class="flex items-center space-x-2 bg-gray-900 text-white p-2 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span>Panel de Control</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-box"></i>
                    <span>Productos</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-warehouse"></i>
                    <span>Almacenes</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Ventas</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transferencias</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reportes</span>
                </a>
                <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="#" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
                <?php endif; ?>
                <a href="logout.php" class="flex items-center space-x-2 hover:bg-gray-700 p-2 rounded-lg text-red-400">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold">Panel de Control</h2>
                    <p class="text-gray-600">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        <i class="fas fa-plus mr-2"></i>
                        Nueva Venta
                    </button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Productos</p>
                            <h3 class="text-2xl font-bold">0</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-box text-blue-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Ventas del Mes</p>
                            <h3 class="text-2xl font-bold">$0</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-dollar-sign text-green-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Clientes</p>
                            <h3 class="text-2xl font-bold">0</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-users text-purple-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Almacenes</p>
                            <h3 class="text-2xl font-bold">1</h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-warehouse text-yellow-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Actividad Reciente</h3>
                <div class="text-gray-500 text-center py-4">
                    <i class="fas fa-info-circle mb-2"></i>
                    <p>No hay actividad reciente para mostrar.</p>
                </div>
            </div>
        </main>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>