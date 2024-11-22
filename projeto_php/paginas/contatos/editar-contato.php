<?php 
$idContato = $_GET["idContato"];

$sql = "SELECT * FROM agenda_telefonica.tb_contato tbcontato WHERE idContato= {$idContato}";
$rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta." . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);
?>
<header class="text-center">
    <h3><i class="bi bi-pencil-square"></i> Editar Contato</h3>
</header>

<div class="container d-flex justify-content-center">
    <form  class=" col-12 col-md-8 col-lg-6 needs-validation" action="index.php?menuop=atualizar-contato" method="post" class="w-50" novalidate>

        <div>
            <label for="idContato">ID:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                <input class="form-control" type="text" name="idContato" value="<?= $dados["idContato"] ?>" readonly>
            </div>
        </div>
        
        <div>
            <label for="nomeContato">Nome:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="nomeContato" value="<?= $dados["nomeContato"] ?>" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Campo obrigatório de no máximo 255 caracteres.</div>
            </div>
        </div>

        <div>
            <label for="telefoneContato">Telefone:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="text" name="telefoneContato" value="<?= $dados["telefoneContato"] ?>" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor, digite um número correto!</div>
            </div>
        </div>

        <div>
            <label for="emailContato">E-mail:</label>
            <div class="input-group mb-3">
                <span class="input-group-text">@</span>
                <input class="form-control" type="email" name="emailContato" value="<?= $dados["emailContato"] ?>" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor, digite um e-mail válido!</div>
            </div>
        </div>

        <div>
            <label for="enderecoContato">Endereço:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                <input class="form-control" type="text" name="enderecoContato" value="<?= $dados["enderecoContato"] ?>" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Por favor, digite um endereço correto!</div>
            </div>
        </div>

        <div>
            <label for="data_nasc_Contato">Data de Nascimento:</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input class="form-control" type="date" name="data_nasc_Contato" value="<?= $dados["data_nasc_Contato"] ?>" required>
                <div class="valid-feedback">Está tudo correto, prossiga!</div>
                <div class="invalid-feedback">Digite uma data de nascimento válida!</div>
            </div>
        </div>

        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Atualizar" name="btnAtualizar">
        </div>
    </form>
</div>

<!-- Link para o arquivo JavaScript externo -->
<script src="js/validation.js"></script>

<!-- JavaScript do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
