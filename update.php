<?php
include('conexao.php');

// Verificar se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar o usuário pelo ID
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Usuário não encontrado.";
        exit;
    }

    $nome = $row['nome'];
    $email = $row['email'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar os campos
    $errors = [];
    if (empty($nome)) {
        $errors[] = "Nome é obrigatório!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail inválido!";
    }

    if (strlen($senha) < 8) {
        $errors[] = "A senha deve ter pelo menos 8 caracteres!";
    }

    if (empty($errors)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Criptografar a senha
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senhaHash' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>Usuário atualizado com sucesso!</p>";
            header("Location: read.php");
            exit;  // Para garantir que o redirecionamento seja feito imediatamente
        } else {
            echo "<p class='error'>Erro: " . $conn->error . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
?>

<h2>
    <slot><i>Editar Usuário</i></slot>
</h2>
<form action="update.php?id=<?php echo $id; ?>" method="POST" class="form-container">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required><br>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required><br>

    <input type="submit" value="Atualizar">
</form>

<style>
/* Estilos Gerais */
body {
    font-family: 'Arial', sans-serif;
    background-color: rgb(161, 190, 233);
    /* Fundo azul suave */
    margin: 0;
    padding: 0;
    color: #333;
}

h2 {
    color: #005f99;
    /* Azul */
    font-size: 2rem;
    text-align: center;
    margin-top: 20px;
}

/* Estilos do Formulário */
.form-container {
    background-color: #fff;
    padding: 30px;
    max-width: 500px;
    margin: 20px auto;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
}

.form-container:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

label {
    font-size: 1.1rem;
    margin-bottom: 10px;
    display: block;
    color: #333;
}

/* Estilo dos campos de input */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 14px;
    margin: 8px 0 20px 0;
    border: 2px solid #005f99;
    /* Azul */
    border-radius: 8px;
    font-size: 1rem;
    background-color: #f7f9fb;
    box-sizing: border-box;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

/* Estilo de foco nos campos */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: rgb(0, 219, 29);
    /* Azul mais claro */
    box-shadow: 0 0 8px rgba(0, 111, 219, 0.3);
    outline: none;
}

/* Feedback de erro - Borda vermelha para campos inválidos */
input[type="text"].error,
input[type="email"].error,
input[type="password"].error {
    border-color: #e74c3c;
    /* Vermelho */
}

input[type="text"]:invalid,
input[type="email"]:invalid,
input[type="password"]:invalid {
    border-color: #e74c3c;
}

/* Estilos para o botão de submit */
input[type="submit"] {
    background-color: #005f99;
    /* Azul */
    color: white;
    border: none;
    padding: 14px 20px;
    font-size: 1.1rem;
    cursor: pointer;
    border-radius: 8px;
    width: 100%;
    letter-spacing: 1px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

input[type="submit"]:hover {
    background-color: rgb(1, 209, 18);
    /* Azul mais escuro */
    transform: translateY(-2px);
}

input[type="submit"]:active {
    transform: translateY(2px);
}

/* Mensagens de erro e sucesso */
.error {
    color: #e74c3c;
    /* Vermelho */
    font-size: 1rem;
    margin-top: 10px;
    text-align: center;
}

.success {
    color: #2ecc71;
    /* Verde */
    font-size: 1rem;
    margin-top: 10px;
    text-align: center;
}

/* Responsividade para telas menores */
@media screen and (max-width: 600px) {
    .form-container {
        padding: 20px;
        width: 90%;
    }

    h2 {
        font-size: 1.5rem;
    }

    input[type="submit"] {
        width: 100%;
    }
}
</style>