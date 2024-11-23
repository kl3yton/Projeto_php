<?php
// Inclui o arquivo que contém a conexão com o banco de dados
include("db/db_agenda.php");

// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Verifica se as variáveis de login e senha estão configuradas na sessão
if (isset($_SESSION["loginUser"]) && isset($_SESSION["senhaUser"])) {
    // Atribui os valores da sessão para variáveis locais
    $loginUser = $_SESSION["loginUser"];
    $senhaUser = $_SESSION["senhaUser"];
    $nomeUser = $_SESSION["nomeUser"];

    // Executa a consulta no banco de dados para verificar o usuário
    $sql = "SELECT * FROM tb_usuarios WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUser}'";
    $rs = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($rs); // Recupera os dados do usuário
    $linha = mysqli_num_rows($rs); // Conta o número de registros encontrados

    // Se não encontrar o usuário no banco de dados, desconecta a sessão e redireciona para o login
    if ($linha == 0) {
        session_unset(); // Limpa as variáveis de sessão
        session_destroy(); // Destrói a sessão
        header('Location: login.php'); // Redireciona para a página de login
        exit(); // Interrompe a execução do código
    }
} else {
    // Caso o usuário não esteja logado, redireciona para a página de login
    header('Location: login.php');
    exit(); // Interrompe a execução do código
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusão do CSS do Bootstrap para estilizar o site -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Inclusão de ícones do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Arquivo de estilo adicional para o site -->
    <link rel="stylesheet" href="css/estilo-padrao.css">
    
    <!-- Título da página -->
    <title>Sistema de Agendas</title>
</head>

<body>
    <header class="bg-dark">
        <div class="container">
            <!-- Barra de navegação do site -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <!-- Logo do site que redireciona para a home -->
                <a class="navbar-brand" href="index.php?menuop=home">
                    <img src="img/logo_agendador.png" alt="Sis-Agendador" width="120">
                </a>

                <!-- Menu de navegação -->
                <div class="collapse navbar-collapse" id="ConteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">
                        <!-- Links para as diferentes páginas -->
                        <li class="nav-item active" id="home"><a class="nav-link" href="index.php?menuop=home">Home</a></li>
                        <li class="nav-item" id="contatos"><a class="nav-link" href="index.php?menuop=contatos">Contatos</a></li>
                    </ul>
                    <div class="navbar-nav w-100 justify-content-end">
                        <!-- Link de logout com o nome do usuário exibido -->
                        <a href="logout.php" class="nav-link">
                            <i class="bi bi-person"></i>
                            <?=$nomeUser?> Sair <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <?php
            // Verifica qual página do menu foi selecionada e inclui o conteúdo correspondente
            $menuop = (isset($_GET["menuop"])) ? $_GET["menuop"] : "home";
            switch ($menuop) {
                case 'home':
                    include("paginas/home/home.php"); // Inclui a página home
                    break;
                case 'contatos':
                    include("paginas/contatos/contatos.php"); // Inclui a página de contatos
                    break;
                case 'cad-contatos':
                    include("paginas/contatos/cad-contato.php"); // Inclui a página para cadastro de contatos
                    break;
                case 'inserir-contato':
                    include("paginas/contatos/inserir-contato.php"); // Inclui a página para inserir novo contato
                    break;
                case 'editar-contato':
                    include("paginas/contatos/editar-contato.php"); // Inclui a página para editar um contato
                    break;
                case 'excluir-contato':
                    include("paginas/contatos/excluir-contato.php"); // Inclui a página para excluir um contato
                    break;
                case 'atualizar-contato':
                    include("paginas/contatos/atualizar-contato.php"); // Inclui a página para atualizar um contato
                    break;
                default:
                    include("paginas/home/home.php"); // Inclui a página home como padrão
                    break;
            }
            ?>
        </div>
    </main>

    <!-- Rodapé do site -->
    <footer class="container-fluid bg-dark">
        <div class="text-center">Sistema Agendador V 1.0</div>
    </footer>

    <!-- Scripts JS do Bootstrap e JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <!-- Script de validação personalizado -->
    <script src="./js/validation.js"></script>
</body>

</html>
