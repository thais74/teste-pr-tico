<?php
// Configurações de depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');

// Verifique o método de requisição
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Método não permitido");
}

// Inclua o arquivo de conexão
require_once 'conexao.php';

try {
    // Processamento dos dados
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];

    if (isset($_POST['excluir'])) {
        // Lógica de exclusão
        $stmt = $conn->prepare("DELETE FROM corretores WHERE id = ?");
        $stmt->execute([$_POST['excluir']]);
    } elseif (empty($id)) {
        // Inserção de novo registro
        $stmt = $conn->prepare("INSERT INTO corretores (nome, cpf, creci) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $cpf, $creci]);
    } else {
        // Atualização de registro existente
        $stmt = $conn->prepare("UPDATE corretores SET nome = ?, cpf = ?, creci = ? WHERE id = ?");
        $stmt->execute([$nome, $cpf, $creci, $id]);
    }

    // Redirecionar após operação
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

} catch (Exception $e) {
    // Tratamento de erros
    echo "Erro: " . $e->getMessage();
    exit();
}
?>
