<?php

$host = 'localhost';
$user = 'root';
$pass = ''; // Senha padrão do XAMPP é vazia
$db   = 'loja_crud';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>