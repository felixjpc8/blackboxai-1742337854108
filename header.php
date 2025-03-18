<?php
if (!isset($pageTitle)) {
    $pageTitle = "Inventario ITEVO";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Inventario ITEVO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar Toggle Button (Mobile) -->
        <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow-lg">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navigation Bar -->
            <nav class="bg-white shadow-md">
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo/Brand -->
                            <div class="flex-shrink-0 flex items-center">
                                <span class="text-2xl font-bold text-gray-800">ITEVO</span>
                            </div>
                        </div>

                        <!-- Right side navigation items -->
                        <div class="flex items-center">
                            <!-- User Dropdown -->
                            <div class="ml-3 relative">
                                <div class="flex items-center">
                                    <span class="text-gray-700 mr-2"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?></span>
                                    <button class="bg-gray-100 p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                                        <i class="fas fa-user-circle text-2xl"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Logout Button -->
                            <div class="ml-4">
                                <a href="logout.php" class="text-gray-600 hover:text-gray-800">
                                    <i class="fas fa-sign-out-alt text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    <!-- Page header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-semibold text-gray-800"><?php echo $pageTitle; ?></h1>
                    </div>