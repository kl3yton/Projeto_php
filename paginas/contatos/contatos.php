<?php 
    include ("db/db_agenda.php");
?>
<head>
    <h3>Contatos</h3>
</head>
<div>
    <a href="index.php?menuop=cad-contatos">Novo Contato</a>
</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de Nasc.</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $sql = "SELECT * FROM tb_contato";
    $rs = mysqli_query($conexao,$sql) or die("Erro ao conectar a consulta" . mysqli_error($conexao));

    while ($dados = mysqli_fetch_assoc($rs)) {
        ?>
            <tr>
                <td><?=$dados["idcontato"] ?></td>
                <td><?=$dados["nomeContato"] ?></td>
                <td><?=$dados["emailContato"] ?></td>
                <td><?=$dados["telefoneContato"] ?></td>
                <td><?=$dados["data_nasc_Contato"] ?></td>
            </tr>
        <?php 
            }
        ?>
        </tbody>
    </table>