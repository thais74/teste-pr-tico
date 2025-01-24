<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corretores";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

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
            <button onclick='editBroker(".$row["id"].")'>Editar</button>
            <button onclick='deleteBroker(".$row["id"].")'>Excluir</button>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}
$conn->close();
?>
