<?php   
// Inclui a conexão com o banco de dados
include ("db/db_agenda.php");

// Variável para armazenar mensagens de erro, se necessário
$msg_error = "";

// Verifica se as variáveis 'loginUser' e 'senhaUser' foram enviadas via POST
if (isset($_POST["loginUser"]) && isset($_POST["senhaUser"])) {
    // Escapa as entradas para evitar SQL injection e calcula o hash da senha
    $loginUser = mysqli_escape_string($conexao,$_POST["loginUser"]);
    $senhaUser = hash('sha256',$_POST["senhaUser"]); // Criptografa a senha com SHA256

    // SQL para verificar a existência do usuário e da senha no banco de dados
    $sql = "SELECT * FROM tb_usuarios WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUser}'";
    $rs = mysqli_query($conexao, $sql); // Executa a consulta
    $dados = mysqli_fetch_assoc($rs); // Armazena os dados do usuário
    $linha = mysqli_num_rows($rs); // Conta quantos resultados foram encontrados

    // Se o usuário for encontrado, inicia a sessão e redireciona para a página principal
    if ($linha > 0) {
        session_start(); // Inicia a sessão
        $_SESSION["loginUser"] = $loginUser; // Armazena o login do usuário na sessão
        $_SESSION["senhaUser"] = $senhaUser; // Armazena a senha criptografada na sessão
        $_SESSION["nomeUser"] = $dados["nomeUser"]; // Armazena o nome do usuário na sessão

        header('Location: index.php'); // Redireciona para a página principal
    } else {
        // Se o login falhar, exibe uma mensagem de erro
        $msg_error = "<div class='alert alert-danger mt-3'>
                        <p>Usuário não encontrado ou a senha não confere</p>
                      </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Inclusão do CSS do Bootstrap para estilizar a página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> <!-- Ícones do Bootstrap -->
    <title>Login - Agendador</title> <!-- Título da página -->
</head>
<body class="bg-secondary">

    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <!-- Formulário de login com uma estrutura de 4 colunas (em dispositivos maiores) -->
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 p-4 bg-white shadow rounded">
                <div class="row justify-content-center mb-4">
                    <!-- Logo do sistema exibido no topo -->
                    <img src="./img/logo_agendador.png" alt="Agendador">
                </div>
                <!-- Formulário para login -->
                <form class="row g-3 needs-validation" action="login.php" method="post" novalidate>
                    <div class="form-group mb-4">
                        <label class="form-label" for="loginUser">Login</label>
                        <div class="input-group">
                            <!-- Ícone para o campo de login -->
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input class="form-control" type="text" name="loginUser" id="loginUser" required> <!-- Campo de login -->
                            <div class="valid-feedback">Está tudo correto, prossiga!</div> <!-- Feedback de validação -->
                            <div class="invalid-feedback">Nome do usuário está incorreto!</div> <!-- Feedback de erro -->
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="senhaUser">Senha</label>
                        <div class="input-group">
                            <!-- Ícone para o campo de senha -->
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input class="form-control" type="password" name="senhaUser" id="senhaUser" required> <!-- Campo de senha -->
                            <div class="valid-feedback">Está tudo correto, prossiga!</div> <!-- Feedback de validação -->
                            <div class="invalid-feedback">A senha digitada está incorreta!</div> <!-- Feedback de erro -->
                        </div>
                        
                        <!-- Exibe a mensagem de erro se o login falhar -->
                        <?php 
                            echo $msg_error;
                        ?>
                    </div>
                    
                    <!-- Botão de login -->
                    <button class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Inclusão dos scripts JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <!-- Script de validação personalizada do formulário -->
    <script src="./js/validation.js"></script>
</body>
</html>
