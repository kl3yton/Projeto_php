<?php
include("db/db_agenda.php");

// Captura a pesquisa
$txt_pesquisa = isset($_POST["txt_pesquisa"]) ? $_POST["txt_pesquisa"] : "";

// Alterna entre o status de concluído ou não concluído.
$idTarefa = isset($_GET['idTarefa']) ? (int)$_GET['idTarefa'] : 0;
$statusTarefa = (isset($_GET["statusTarefa"]) && $_GET['statusTarefa'] == '0') ? '1' : '0';

// Atualiza o status da tarefa
if ($idTarefa > 0) {
    $sql = "UPDATE tb_tarefas SET statusTarefa = ? WHERE idTarefa = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $statusTarefa, $idTarefa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Configurações de paginação
$quantidade = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $quantidade;

// Consulta de tarefas com pesquisa e paginação
$sql = "SELECT
            idTarefa,
            statusTarefa,
            tituloTarefa,
            descricaoTarefa,
            DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') AS dataConclusaoTarefa,
            horaConclusaoTarefa
        FROM tb_tarefas
        WHERE
            tituloTarefa LIKE ? OR 
            descricaoTarefa LIKE ? OR
            DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') LIKE ?
        ORDER BY statusTarefa, dataConclusaoTarefa
        LIMIT ?, ?";

$stmt = mysqli_prepare($conexao, $sql);
$likePesquisa = "%" . $txt_pesquisa . "%";
mysqli_stmt_bind_param($stmt, 'sssss', $likePesquisa, $likePesquisa, $likePesquisa, $inicio, $quantidade);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);

// Conta o total de tarefas
$sqlTotal = "SELECT idTarefa FROM tb_tarefas WHERE tituloTarefa LIKE ? OR descricaoTarefa LIKE ? OR DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') LIKE ?";
$stmtTotal = mysqli_prepare($conexao, $sqlTotal);
mysqli_stmt_bind_param($stmtTotal, 'sss', $likePesquisa, $likePesquisa, $likePesquisa);
mysqli_stmt_execute($stmtTotal);
$qrTotal = mysqli_stmt_get_result($stmtTotal);
$numTotal = mysqli_num_rows($qrTotal);
mysqli_stmt_close($stmtTotal);

$totalPagina = ceil($numTotal / $quantidade);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tarefas</title>
    <!-- Inclua o Bootstrap e outros recursos, se necessário -->
</head>
<body>
    <h3><i class="bi bi-list-task"> </i>Tarefas</h3>

    <div>
        <a class="btn btn-outline-primary mb-2" href="index.php?menuop=cad-terefas"><i class="bi bi-list-task"></i> Nova Tarefa</a>
    </div>

    <div>
        <form action="index.php?menuop=tarefas" method="post">
            <div class="input-group">
                <input class="form-control col-3" type="text" name="txt_pesquisa" value="<?=$txt_pesquisa?>">
                <button class="btn btn-outline-success btn-sm" type="submit"> <i class="bi bi-search"> </i>Pesquisa</button>
            </div>
        </form>
    </div>

    <div class="table1">
        <table class="table table-dark table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data da Conclusão</th>
                    <th>Hora da Conclusão</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($dados = mysqli_fetch_assoc($rs)) {
            ?>
                <tr>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="index.php?menuop=tarefas&pagina=<?=$pagina?>&idTarefa=<?=$dados['idTarefa']?>&statusTarefa=<?=$dados['statusTarefa']?>">
                            <?php 
                                if ($dados['statusTarefa'] == 0) { 
                                    echo '<i class="bi bi-square"></i>';
                                } else {
                                    echo '<i class="bi bi-check-square"></i>';
                                }
                            ?>
                        </a>
                    </td>
                    <td class="text-nowrap"><?=$dados["tituloTarefa"] ?></td>
                    <td class="text-nowrap"><?=$dados["descricaoTarefa"] ?></td>
                    <td class="text-nowrap"><?=$dados["dataConclusaoTarefa"] ?></td>
                    <td class="text-nowrap"><?=$dados["horaConclusaoTarefa"] ?></td>
                    <td class="text-center">
                        <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-tareda&idTarefa=<?=$dados["idTarefa"] ?>"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-danger btn-sm" href="index.php?menuop=excluir-terefa&idTarefa=<?=$dados["idTarefa"] ?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>
    </div>

    <br>

    <ul class="pagination justify-content-center">
        <?php 
        // Primeira página
        echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=1">Primeira Página</a></li>';

        // Página anterior
        if ($pagina > 1) {
            echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=' . ($pagina - 1) . '"> << </a></li>';
        }

        // Páginas de navegação
        for ($i = 1; $i <= $totalPagina; $i++) {
            if ($i >= ($pagina - 5) && $i <= ($pagina + 5)) {
                if ($i == $pagina) {
                    echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?menuop=tarefas&pagina=$i'>$i</a></li>";
                }
            }
        }

        // Página seguinte
        if ($pagina < $totalPagina) {
            echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=' . ($pagina + 1) . '"> >> </a></li>';
        }

        // Última página
        echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=' . $totalPagina . '">Última Página</a></li>';
        ?>
    </ul>
</body>
</html>

<?php
// Fechar a conexão
mysqli_close($conexao);
?>
