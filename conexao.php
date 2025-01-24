<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corretores_db";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
