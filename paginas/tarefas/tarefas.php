<?php 
    include ("db/db_agenda.php");
    $txt_pesquisa = isset($_POST["txt_pesquisa"]) ? $_POST["txt_pesquisa"] : "";

    //Alterna entre o status de concluido ou nãoconcluido.
    $idTarefa = (isset($_GET['idTarefa']))?$_GET['idTarefa'] : "";
    $statusTarefa = (isset($_GET["statusTarefa"]) and $_GET['statusTarefa'] =='0')?'1':'0';

    $sql = "UPDATE tb_tarefas SET statusTarefa = '{$statusTarefa}' WHERE idTarefa = {$idTarefa}";
    $rs =  mysqli_query($conexao, $sql);
?>
<head>
    <h3><i class="bi bi-list-task"> </i>Tarefas</h3>
</head>
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
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Data da Conclusão</th>
                <th>Hora da Conclusão</th>
                <th>Editar</th>
                <th>Excluir</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
            // paginação aula-10
            $quantidade = 10;
            
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

            $inicio = ($pagina - 1) * $quantidade;

            $sql = "SELECT
            idTarefa,
            statusTarefa,
            tituloTarefa,
            descricaoTarefa,
            DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') AS dataConclusaoTarefa,
            horaConclusaoTarefa
        FROM tb_tarefas
        WHERE
            tituloTarefa LIKE '%{$txt_pesquisa}%' OR 
            descricaoTarefa LIKE '%{$txt_pesquisa}%' OR
            DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') LIKE '%{$txt_pesquisa}%'
            ORDER BY statusTarefa, dataConclusaoTarefa
        LIMIT $inicio, $quantidade";

// Executa a consulta
$rs = mysqli_query($conexao, $sql) or die("Erro ao conectar a consulta: " . mysqli_error($conexao));

// Exibe os resultados
while ($dados = mysqli_fetch_assoc($rs)) {
    ?>
    <tr>
        <td>
        <a class="btn btn-secondary btn-sm" href="index.php?menuop=tarefas&pagina=<?=$pagina?>&idTarefa=<?=$dados['idTarefa']?>&statusTarefa=<?=$dados['statusTarefa']?>">

                <?php 
                    if ($dados['statusTarefa'] == 0) { // Correção do erro de comparação
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
    // contar o total de registros
    $sqlTotal = "SELECT idTarefa FROM tb_tarefas";
    $qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
    $numTotal = mysqli_num_rows($qrTotal);

    $totalPagina = ceil($numTotal / $quantidade);
    
    echo '<li class="page-item"><span class="page-link">Total de registros: ' . $numTotal . '</span></li>';

    echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=1">Primeira Página</a></li>';

    if ($pagina > 1) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=terefas&pagina=<?php echo $pagina - 1; ?>"> << </a></li>
        <?php
    }

    for ($i = 1; $i <= $totalPagina; $i++) {
        if($i>=($pagina-5) && $i <= ($pagina+5)){
            if ($i == $pagina) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
            } else {
                echo "<li clas='page-item'><a class='page-link'href=\"?menuop=tarefas&pagina=$i\">$i</a></li>";
            }
        }
    }

    if ($pagina < $totalPagina) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=terefas&pagina=<?php echo $pagina + 1; ?>"> >> </a></li>
        <?php
    }

    echo "<li class='page-item'><a class='page-link' href=\"?menuop=terefas&pagina=$totalPagina\">Última Página</a></li>";
?>
</ul>



