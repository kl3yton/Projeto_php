<?php 
    include ("db/db_agenda.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link CDN pego do bootstrap aula-11 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/estilo-padrao.css">
    <title>Sistema de Agendas</title>
</head>
<body>
    <header>
        <h1>Sistema Agendador 1.0</h1>
        
        <nav> <!-- tag menuop é usada para url -->
            <a href="index.php?menuop=home">Home</a>
            <a href="index.php?menuop=contatos">Contatos</a>
            <a href="index.php?menuop=tarefas">Tarefas</a>
            <a href="index.php?menuop=eventos">Eventos</a>
        </nav>
    </header> 
    <hr>
    <main>
        <?php //Quando clicar no link e ele é encaminhado para um local do site.
            $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"home";
            switch ($menuop) {
                case 'home':
                    include("paginas/home/home.php");
                    break;
                case 'contatos':
                    include("paginas/contatos/contatos.php");
                    break;
                case 'cad-contatos':
                    include("paginas/contatos/cad-contato.php");
                    break;
                case 'inserir-contato':
                    include("paginas/contatos/inserir-contato.php");
                    break;
                case 'editar-contato':
                        include("paginas/contatos/editar-contato.php");
                    break;
                case 'excluir-contato':
                        include("paginas/contatos/excluir-contato.php");
                    break;
                case 'atualizar-contato':
                        include("paginas/contatos/atualizar-contato.php");
                        break;
                case 'tarefas':
                    include("paginas/tarefas/tarefas.php");
                    break;
                case 'eventos':
                    include("paginas/eventos/eventos.php");
                    break;
                default:
                    include("paginas/home/home.php");
                        break;
            }
        ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>
