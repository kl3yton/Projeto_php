<header>
    <h3>
        <i class="bi bi-list-task"></i> Inserir Tarefa
    </h3>
</header>

<?php
include("db/db_agenda.php");

// Captura os dados do formulário
$tituloTarefa = isset($_POST['tituloTarefa']) ? $_POST['tituloTarefa'] : '';
$descricaoTarefa = isset($_POST['descricaoTarefa']) ? $_POST['descricaoTarefa'] : '';
$dataConclusaoTarefa = isset($_POST['dataConclusaoTarefa']) ? $_POST['dataConclusaoTarefa'] : '';
$horaConclusaoTarefa = isset($_POST['horaConclusaoTarefa']) ? $_POST['horaConclusaoTarefa'] : '';
$dataLembreteTarefa = isset($_POST['dataLembreteTarefa']) ? $_POST['dataLembreteTarefa'] : null;
$horaLembreteTarefa = isset($_POST['horaLembreteTarefa']) ? $_POST['horaLembreteTarefa'] : null;
$recorrenciaTarefa = isset($_POST['recorrenciaTarefa']) ? $_POST['recorrenciaTarefa'] : 0;

// Verifica se todos os dados necessários estão preenchidos
if ($tituloTarefa && $descricaoTarefa && $dataConclusaoTarefa && $horaConclusaoTarefa) {
    $sql = "INSERT INTO tb_tarefas (tituloTarefa, descricaoTarefa, dataConclusaoTarefa, horaConclusaoTarefa, dataLembreteTarefa, horaLembreteTarefa, recorrenciaTarefa) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $tituloTarefa, $descricaoTarefa, $dataConclusaoTarefa, $horaConclusaoTarefa, $dataLembreteTarefa, $horaLembreteTarefa, $recorrenciaTarefa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "Tarefa inserida com sucesso!";
} else {
    echo "Erro: Todos os campos obrigatórios devem ser preenchidos.";
}

mysqli_close($conexao);
?>
