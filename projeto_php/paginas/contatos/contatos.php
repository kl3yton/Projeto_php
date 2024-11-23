<?php 
    include ("db/db_agenda.php");

    // Váriavel da pesquisa - Se não houver um valor passado, define como uma string vazia
    $txt_pesquisa = isset($_POST["txt_pesquisa"]) ? $_POST["txt_pesquisa"] : "";

?>
<head>
    <h3><i class="bi bi-person-square"> </i>Contatos</h3>
</head>

<div>
    <!-- Botão para adicionar novo contato -->
    <a class="btn btn-outline-primary mb-2" href="index.php?menuop=cad-contatos"><i class="bi bi-person-fill-add"></i> Novo Contato</a>
</div>

<div>
    <!-- Formulário de pesquisa de contatos -->
    <form action="index.php?menuop=contatos" method="post">
        <div class="input-group">
            <!-- Campo de pesquisa para nome ou ID do contato -->
            <input class="form-control col-3" type="text" name="txt_pesquisa" value="<?=$txt_pesquisa?>">
            <!-- Botão de pesquisa -->
            <button class="btn btn-outline-success btn-sm" type="submit"> <i class="bi bi-search"> </i>Pesquisa</button>
        </div>
    </form>
</div>

<div class="table1">
    <!-- Tabela para exibir os contatos -->
    <table class="table table-dark table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Data de Nasc.</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Definir a quantidade de contatos por página
            $quantidade = 5;
            
            // Verifica qual página estamos (padrão é 1)
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

            // Define a partir de qual linha a consulta vai retornar os resultados
            $inicio = ($pagina - 1) * $quantidade;

            // Consulta SQL para listar os contatos com base no termo de pesquisa
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
                    ORDER BY idContato ASC  
                    LIMIT $inicio, $quantidade";  

            // Executa a consulta SQL
            $rs = mysqli_query($conexao, $sql) or die("Erro ao conectar a consulta: " . mysqli_error($conexao));

            // Exibe os resultados da consulta
            while ($dados = mysqli_fetch_assoc($rs)) {
        ?>
            <tr>
                <td><?=$dados["idContato"] ?></td>
                <td class="text-nowrap"><?=$dados["nomeContato"] ?></td>
                <td class="text-nowrap"><?=$dados["telefoneContato"] ?></td>
                <td class="text-nowrap"><?=$dados["emailContato"] ?></td>
                <td class="text-nowrap"><?=$dados["enderecoContato"] ?></td>
                <td><?=$dados["data_nasc_Contato"] ?></td>
                <td class="text-center">
                    <!-- Link para editar o contato -->
                    <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-contato&idContato=<?=$dados["idContato"] ?>"><i class="bi bi-pencil-square"></i></a>
                </td>
                <td class="text-center">
                    <!-- Link para excluir o contato -->
                    <a class="btn btn-outline-danger btn-sm" href="index.php?menuop=excluir-contato&idContato=<?=$dados["idContato"] ?>"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
    <?php 
        }
        ?>
        </tbody>
    </table>
</div>
<br>

<!-- Exibição da paginação -->
<ul class="pagination justify-content-center">
<?php 
    // Conta o total de registros de contatos
    $sqlTotal = "SELECT idContato FROM tb_contato";
    $qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
    $numTotal = mysqli_num_rows($qrTotal);

    // Calcula o número total de páginas
    $totalPagina = ceil($numTotal / $quantidade);
    
    // Exibe o total de registros
    echo '<li class="page-item"><span class="page-link">Total de registros: ' . $numTotal . '</span></li>';

    // Link para a primeira página
    echo '<li class="page-item"><a class="page-link" href="?menuop=contatos&pagina=1">Primeira Página</a></li>';

    // Link para a página anterior, se houver
    if ($pagina > 1) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=contatos&pagina=<?php echo $pagina - 1; ?>"> << </a></li>
        <?php
    }

    // Exibe os números das páginas de forma dinâmica, limitando o alcance para 5 páginas ao redor da página atual
    for ($i = 1; $i <= $totalPagina; $i++) {
        if($i>=($pagina-5) && $i <= ($pagina+5)){
            if ($i == $pagina) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=contatos&pagina=$i\">$i</a></li>";
            }
        }
    }

    // Link para a próxima página, se houver
    if ($pagina < $totalPagina) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=contatos&pagina=<?php echo $pagina + 1; ?>"> >> </a></li>
        <?php
    }

    // Link para a última página
    echo "<li class='page-item'><a class='page-link' href=\"?menuop=contatos&pagina=$totalPagina\">Última Página</a></li>";
?>
</ul>
