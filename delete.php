<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corretores";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi enviado e é válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar e executar a query de exclusão
    $sql = "DELETE FROM corretores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?status=delete_success");
    } else {
        header("Location: index.php?status=delete_error");
    }
    

    $stmt->close();
} else {
    // ID inválido
    header("Location: index.php?delete=invalid");
    exit();
}


// Fechar conexão
$conn->close();
?>
