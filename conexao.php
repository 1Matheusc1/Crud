<?php
// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "112233";
$dbname = "curso";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
echo "Conexão bem-sucedida";
?>