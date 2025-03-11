<?php
// Incluir o arquivo de conexão
include('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $erros = []; // Array para armazenar erros

    // Validação dos campos
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "<br><b>E-mail inválido!</b> Certifique-se de que está no formato correto (ex: exemplo@gmail.com).";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $erros[] = "<br><b>E-mail deve ser do domínio @gmail.com!</b> O domínio deve ser exatamente '@gmail.com'.";
    }

    // Validação da senha
    if (strlen($senha) < 8) {
        $erros[] = "<strong>A senha deve ter pelo menos 8 caracteres!";
    }

  
    if (count($erros) > 0) {
        foreach ($erros as $erro) {
            echo $erro . "<br>"; 
        }
        exit;
    }
 
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaHash')";

    if ($conn->query($sql) === TRUE) {

        header("Location: read.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>
