<?php
try {
    new PDO('mysql:host=localhost;dbname=test', 'root', '');
    echo "¡Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}