<?php
require_once 'database.php';

try {
    // Verificar tabla de usuarios
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $users = $stmt->fetchAll();
    echo "Usuarios encontrados: " . count($users) . "\n";
    foreach ($users as $user) {
        echo "- " . $user['username'] . " (rol: " . $user['rol'] . ")\n";
    }
    
    // Verificar si las tablas existen
    $tables = [
        'usuarios', 'categorias', 'almacenes', 'productos', 'inventario',
        'clientes', 'clientes_asociados', 'ventas', 'ventas_detalle',
        'devoluciones', 'devoluciones_detalle', 'transferencias',
        'transferencias_detalle', 'cuentas_por_cobrar', 'cuentas_por_pagar',
        'recepciones', 'recepciones_detalle', 'cancelaciones'
    ];
    
    echo "\nVerificando tablas:\n";
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table");
            $count = $stmt->fetch()['count'];
            echo "- $table: OK ($count registros)\n";
        } catch (PDOException $e) {
            echo "- $table: ERROR - " . $e->getMessage() . "\n";
        }
    }
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
?>