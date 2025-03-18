<?php
require_once 'database.php';

try {
    // Crear nuevo hash de contraseña
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Actualizar contraseña del usuario admin
    $stmt = $pdo->prepare("UPDATE usuarios SET password = ? WHERE username = 'admin'");
    $stmt->execute([$hash]);
    
    // Verificar la actualización
    $stmt = $pdo->query("SELECT username, password FROM usuarios WHERE username = 'admin'");
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        echo "¡Contraseña actualizada exitosamente!\n";
        echo "Usuario: admin\n";
        echo "Contraseña: admin123\n";
        echo "Verificación: " . (password_verify($password, $user['password']) ? "CORRECTO" : "INCORRECTO") . "\n";
    } else {
        echo "Error al actualizar la contraseña\n";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>