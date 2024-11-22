
<?php
$idTarefa = $_GET['idTarefa'];

// Corrigir o nome da tabela se necessário
$sql = "SELECT * FROM tb_tarefas WHERE idTarefa = '$idTarefa'"; // Ajuste para o nome correto da tabela

$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar os dados do registro: " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);
?>

<header>
    <h3>
    <i class="bi bi-list-task"></i> Editar de Tarefa
    </h3>
</header>
<div>
    <form class="needs-validation" action="index.php?menuop=inserir-tarefa" method="post" novalidate>
    <div class="mb-3 col-3">
            <label for="idTarefa" class="form-label">ID</label>
            <input class="form-control" type="text" name="idTarefa" id="idTarefa" value="<?=$dados["idTarefa"]?>" required>
        </div>
        <div class="mb-3">
            <label for="tituloTarefa" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" value="<?=$dados["tituloTarefa"]?>" required>
        </div>
        <div class="mb-3">
            <label for="descricaoTarefa" class="form-label">Descrição</label>
            <textarea name="descricaoTarefa" id="descricaoTarefa" cols="30" rows="5" class="form-control"required><?=$dados["descricaoTarefa"]?>"</textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataConclusaoTarefa" class="form-label">Data de Conclusão</label>
                <input class="form-control" type="date" name="dataConclusaoTarefa" id="dataConclusaoTarefa" value="<?=$dados["dataConclusaoTarefa"]?>" required>
            </div>
            <div class="mb-3 col-3">
                <label for="horaConclusaoTarefa" class="form-label">Hora de Conclusão</label>
                <input class="form-control" type="time" name="horaConclusaoTarefa" id="horaConclusaoTarefa" value="<?=$dados["horaConclusaoTarefa"]?>" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataLembreTarefa" class="form-label">Data de Lembrete</label>
                <input class="form-control" type="date" name="dataLembreTarefa" id="dataLembreTarefa" value="<?=$dados["dataLembreteTarefa"]?>">
            </div>
            <div class="mb-3 col-3">
                <label for="horaLembreTarefa" class="form-label">Hora de Lembrete</label>
                <input class="form-control" type="time" name="horaLembreTarefa" id="horaLembreTarefa" value="<?=$dados["horaLembreteTarefa"]?>">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label  for="recorrenciaTarefa" class="form-label">Recorrência</label>
                <select name="recorrenciaTarefa" id="recorrenciaTarefa" class="form-control">
                    <option value="0">Não Recorrente</option>
                    <option value="1">Diariamente</option>
                    <option value="2">Semanalmente</option>
                    <option value="3">Mensalmente</option>
                    <option value="4">Anualmente</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Atualizar" name="btnatualizar">
        </div>
    </form>
</div>