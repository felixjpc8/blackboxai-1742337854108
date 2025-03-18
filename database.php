<?php
// Configuración de la conexión a la base de datos
define('DB_FILE', __DIR__ . '/db/inventario.sqlite');

// Asegurar que el directorio de la base de datos existe
if (!file_exists(dirname(DB_FILE))) {
    mkdir(dirname(DB_FILE), 0777, true);
}

try {
    // Crear conexión PDO
    $pdo = new PDO(
        "sqlite:" . DB_FILE,
        null,
        null,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    
    // Habilitar soporte para llaves foráneas
    $pdo->exec('PRAGMA foreign_keys = ON');
    
    // Establecer zona horaria
    date_default_timezone_set('America/Mexico_City');
    
} catch(PDOException $e) {
    // Registrar error (en un archivo en un entorno real)
    error_log("Error de conexión: " . $e->getMessage());
    die("Error de conexión a la base de datos. Por favor, contacte al administrador.");
}

// Función para sanitizar entradas
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Función para validar sesión
function checkSession() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>