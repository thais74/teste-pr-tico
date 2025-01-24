<!DOCTYPE html>
<html lang="pt-BR">
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

// Preparar e executar a consulta SQL
$result = null; // Inicialização prévia da variável
$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Corretores</title>
    <?php
// Verificar parâmetros de status na URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = '';
    $messageClass = '';

    switch ($status) {
        case 'create_success':
            $message = "Corretor cadastrado com sucesso!";
            $messageClass = "success";
            break;
        case 'create_error':
            $message = "Erro ao cadastrar corretor.";
            $messageClass = "error";
            break;
        case 'update_success':
            $message = "Corretor atualizado com sucesso!";
            $messageClass = "success";
            break;
        case 'update_error':
            $message = "Erro ao atualizar corretor.";
            $messageClass = "error";
            break;
        case 'delete_success':
            $message = "Corretor excluído com sucesso!";
            $messageClass = "success";
            break;
        case 'delete_error':
            $message = "Erro ao excluir corretor.";
            $messageClass = "error";
            break;
    }

    // Adicionar estilo para as mensagens
    echo "<style>
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
    </style>";

    echo "<div class='message $messageClass'>$message</div>";
}
?>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        form {
            display: grid;
            gap: 15px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }
        input:focus {
            border-color: #007bff;
            outline: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sistema de Gerenciamento de Corretores</h2>
        
        <!-- Formulário de Cadastro -->
        <form id="brokerForm" method="POST" action="processar.php">
            <input type="text" name="cpf" placeholder="CPF" required minlength="11" maxlength="11">
            <input type="text" name="creci" placeholder="Número do Creci" required minlength="2">
            <input type="text" name="nome" placeholder="Nome Completo" required minlength="2">
            <button type="submit" class="btn">Cadastrar Corretor</button>
        </form>

        <!-- Tabela de Corretores -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Creci</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Código de listagem de corretores
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["cpf"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["creci"]) . "</td>";
                        echo "<td>
                            <button class='btn' onclick='editBroker(" . $row["id"] . ")'>Editar</button>
                            <button class='btn btn-danger' onclick='deleteBroker(" . $row["id"] . ")'>Excluir</button>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Nenhum corretor cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="validation.js"></script>
</body>
</html>