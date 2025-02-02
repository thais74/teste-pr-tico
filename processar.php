<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corretores";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$cpf = $_POST['cpf'];
$creci = $_POST['creci'];
$nome = $_POST['nome'];

$sql = "INSERT INTO corretores (name, cpf, creci) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $cpf, $creci);

if ($stmt->execute()) {
    header("Location: index.php?status=create_success");
} else {
    header("Location: index.php?status=create_error");
}


$stmt->close();
$conn->close();
?>
