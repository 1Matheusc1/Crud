<?php
include('conexao.php');

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o usuário
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso!";
        header("Location: read.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>