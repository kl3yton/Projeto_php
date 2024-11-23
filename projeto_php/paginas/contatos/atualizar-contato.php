<header>
    <h3>Atualizar Contato</h3>
</header>

<?php
    // Escapando os valores para prevenir SQL Injection
    $idContato = mysqli_real_escape_string($conexao, $_POST["idContato"]);
    $nomeContato = mysqli_real_escape_string($conexao, $_POST["nomeContato"]);
    $emailContato = mysqli_real_escape_string($conexao, $_POST["emailContato"]);
    $telefoneContato = mysqli_real_escape_string($conexao, $_POST["telefoneContato"]);
    $enderecoContato = mysqli_real_escape_string($conexao, $_POST["enderecoContato"]);
    $data_nasc_Contato = mysqli_real_escape_string($conexao, $_POST["data_nasc_Contato"]);

    // Comando SQL para atualizar os dados na tabela tb_contato
    $sql = "UPDATE agenda_telefonica.tb_contato SET 
        nomeContato = '{$nomeContato}',
        emailContato = '{$emailContato}',
        telefoneContato = '{$telefoneContato}', 
        enderecoContato = '{$enderecoContato}', 
        data_nasc_Contato = '{$data_nasc_Contato}'
        WHERE idContato = '{$idContato}'";

    // Executando a consulta no banco de dados
    mysqli_query($conexao, $sql) or die("Erro ao executar a consulta." . mysqli_error($conexao));

    // Mensagem de sucesso
    echo "O registro foi atualizado com sucesso.";
?>
