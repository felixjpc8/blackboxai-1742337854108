<?php
require_once 'database.php';

try {
    // Leer archivo SQL
    $sql = file_get_contents('database.sql');
    
    // Dividir en declaraciones individuales
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    // Ejecutar cada declaración
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
        }
    }
    
    echo "¡Base de datos SQLite creada exitosamente!\n";
    echo "Puede acceder al sistema usando:\n";
    echo "Usuario: admin\n";
    echo "Contraseña: admin123\n";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
?>