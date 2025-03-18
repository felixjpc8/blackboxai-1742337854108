<?php
require_once 'database.php';

try {
    // Probar la conexión consultando la tabla de usuarios
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
    $result = $stmt->fetch();
    
    echo "¡Conexión exitosa a la base de datos!\n";
    echo "Total de usuarios: " . $result['total'] . "\n";
    
} catch(PDOException $e) {
    // Mostrar error si la conexión falla
    die("Error de conexión: " . $e->getMessage() . "\n");
}
?>