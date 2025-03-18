<?php
require_once 'database.php';

try {
    // Consultar información del usuario admin
    $stmt = $pdo->query("SELECT username, password FROM usuarios WHERE username = 'admin'");
    $user = $stmt->fetch();
    
    if ($user) {
        echo "Usuario: " . $user['username'] . "\n";
        echo "Hash actual: " . $user['password'] . "\n";
        echo "Hash esperado: " . password_hash('admin123', PASSWORD_DEFAULT) . "\n";
        echo "Verificación: " . (password_verify('admin123', $user['password']) ? "CORRECTO" : "INCORRECTO") . "\n";
    } else {
        echo "Usuario admin no encontrado\n";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>