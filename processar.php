<?php
include 'conexao.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die("Método não permitido");
}

// Processamento de Cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $nome = $_POST['nome'];

    // Validações adicionais
    if (strlen($cpf) != 11 || strlen($creci) < 2 || strlen($nome) < 2) {
        echo "Dados inválidos!";
        exit();
    }

    $sql = "INSERT INTO corretores (name, cpf, creci) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $cpf, $creci);
    
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro no cadastro: " . $stmt->error;
    }
    $stmt->close();
}

// Listagem de Corretores
$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Creci</th><th>Ações</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["cpf"]."</td>";
        echo "<td>".$row["creci"]."</td>";
        echo "<td>
            <a href='editar.php?id=".$row["id"]."'>Editar</a> | 
            <a href='excluir.php?id=".$row["id"]."'>Excluir</a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}
$conn->close();
?>
