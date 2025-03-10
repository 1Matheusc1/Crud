<?php
include('conexao.php');

// Consulta para pegar todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<h2>Lista de Usuários</h2>";

echo "<table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>
                    <a href='update.php?id=" . $row['id'] . "'>Editar</a> | 
                    <a href='delete.php?id=" . $row['id'] . "'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhum usuário encontrado.</p>";
}

$conn->close();
?>

<style>
/* Estilos gerais da página */
body {
    font-family: 'Arial', sans-serif;
    background-color: rgb(151, 195, 240);
    /* Fundo suave */
    margin: 0;
    padding: 0;
    color: #333;
}

/* Título */
h2 {
    color: #005f99;
    /* Azul */
    font-size: 2rem;
    text-align: center;
    margin-top: 20px;
}

/* Estilos da tabela */
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
}

th,
td {
    padding: 12px 15px;
    border: 1px solid #005f99;
    /* Azul */
    text-align: left;
}

/* Estilo para as colunas do cabeçalho */
th {
    background-color: #005f99;
    /* Azul */
    color: white;
    font-size: 1.1rem;
}

/* Estilo para as linhas */
tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Estilo dos links (ações) */
a {
    color: #005f99;
    /* Azul */
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #003f5f;
    /* Azul mais escuro */
    text-decoration: underline;
}

/* Mensagem de nenhum usuário */
p {
    text-align: center;
    font-size: 1.2rem;
    color: #777;
}

/* Estilos de responsividade */
@media screen and (max-width: 768px) {
    table {
        width: 95%;
    }

    th,
    td {
        padding: 8px;
    }
}
</style>