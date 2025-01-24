<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Retorna erro 405 se não for POST
    die("Método não permitido");
}

// Recebe os dados do formulário
$cpf = $_POST['cpf'] ?? '';
$creci = $_POST['creci'] ?? '';
$nome = $_POST['nome'] ?? '';

// Valida os dados recebidos
if (empty($cpf) || empty($creci) || empty($nome)) {
    die("Todos os campos são obrigatórios.");
}

// Insere os dados no banco de dados
$sql = "INSERT INTO corretores (name, cpf, creci) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $cpf, $creci);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro no cadastro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
