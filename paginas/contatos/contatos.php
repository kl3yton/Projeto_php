<?php 
    include ("db/db_agenda.php");
?>
<head>
    <h3>Contatos</h3>
</head>
<div>
    <a href="index.php?menuop=cad-contatos">Novo Contato</a>
</div>
<div>
    <form action="index.php?menuop=contatos" method="post">
        <input type="text" name="txt_pesquisa">
        <input type="submit" value="Pesquisa">
    </form>
</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Data de Nasc.</th>
            <th>Editar</th>
            <th>Excluir</th>
            
        </tr>
    </thead>
    <tbody>
    <?php 
    $txt_pesquisa = isset($_POST["txt_pesquisa"]) ? $_POST["txt_pesquisa"] : ""; 
    $sql = "SELECT 
                idContato,
                upper(nomeContato) AS nomeContato,
                lower(emailContato) AS emailContato,
                telefoneContato,
                upper(enderecoContato) AS enderecoContato,
                date_format(data_nasc_Contato, '%d/%m/%y') AS data_nasc_Contato
            FROM agenda_telefonica.tb_contato
            WHERE 
            idContato = '{$txt_pesquisa}' OR
            nomeContato LIKE '%{$txt_pesquisa}%'
            ORDER BY nomeContato ASC";

    $rs = mysqli_query($conexao, $sql) or die("Erro ao conectar a consulta: " . mysqli_error($conexao));

    while ($dados = mysqli_fetch_assoc($rs)) {
        ?>
            <tr>
                <td><?=$dados["idContato"] ?></td>
                <td><?=$dados["nomeContato"] ?></td>
                <td><?=$dados["emailContato"] ?></td>
                <td><?=$dados["telefoneContato"] ?></td>
                <td><?=$dados["enderecoContato"] ?></td>
                <td><?=$dados["data_nasc_Contato"] ?></td>
                <td><a href="index.php?menuop=editar-contato&idContato=<?=$dados["idContato"] ?>">Editar</a></td>
                <td><a href="index.php?menuop=excluir-contato&idContato=<?=$dados["idContato"] ?>">Excluir</a></td>
            </tr>
        <?php 
            }
        ?>
        </tbody>
    </table>