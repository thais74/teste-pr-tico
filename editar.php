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

// Verificar se o ID foi enviado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar dados do corretor específico
    $sql = "SELECT * FROM corretores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $corretor = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Corretor</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #007bff;
        }
        .btn {
            width: 100%;
            padding: 12px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Corretor</h2>
        <form id="editBrokerForm" method="POST" action="atualizar.php">
            <input type="hidden" name="id" value="<?php echo $corretor['id']; ?>">
            
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" 
                       value="<?php echo $corretor['cpf']; ?>" 
                       required minlength="11" maxlength="11">
            </div>
            
            <div class="form-group">
                <label for="creci">Creci</label>
                <input type="text" id="creci" name="creci" 
                       value="<?php echo $corretor['creci']; ?>" 
                       required minlength="2">
            </div>
            
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" 
                       value="<?php echo $corretor['name']; ?>" 
                       required minlength="2">
            </div>
            
            <button type="submit" class="btn">Atualizar Cadastro</button>
        </form>
    </div>

    <script src="validation.js"></script>
</body>
</html>
