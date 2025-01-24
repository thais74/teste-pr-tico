<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corretores";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$id = $_POST['id'];
$cpf = $_POST['cpf'];
$creci = $_POST['creci'];
$nome = $_POST['nome'];

// Preparar e executar a query de atualização
$sql = "UPDATE corretores SET name = ?, cpf = ?, creci = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nome, $cpf, $creci, $id);

if ($stmt->execute()) {
    header("Location: index.php?update=success");
} else {
    header("Location: index.php?update=error");
}


$stmt->close();
$conn->close();
?>
