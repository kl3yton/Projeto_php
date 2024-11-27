<header>
    <h3>Inserir Contato</h3> <!-- Cabeçalho da página de inserção de contatos -->
</header>

<?php 
// Recebe os dados do formulário via POST e utiliza a função 'mysqli_real_escape_string' para evitar ataques de SQL Injection
$nomeContato = mysqli_real_escape_string($conexao, $_POST["nomeContato"]); // Escapa o nome do contato
$emailContato = mysqli_real_escape_string($conexao, $_POST["emailContato"]); // Escapa o e-mail do contato
$telefoneContato = mysqli_real_escape_string($conexao, $_POST["telefoneContato"]); // Escapa o telefone do contato
$enderecoContato = mysqli_real_escape_string($conexao, $_POST["enderecoContato"]); // Escapa o endereço do contato
$data_nasc_Contato = mysqli_real_escape_string($conexao, $_POST["data_nasc_Contato"]); // Escapa a data de nascimento do contato

// Comando SQL para inserir os dados na tabela 'tb_contato'
$sql = "INSERT INTO tb_contato (
    nomeContato,
    emailContato,
    telefoneContato, 
    enderecoContato, 
    data_nasc_Contato)
    VALUES( 
        '{$nomeContato}',
        '{$emailContato}',
        '{$telefoneContato}',
        '{$enderecoContato}',
        '{$data_nasc_Contato}'
    )   
";

// Executa a consulta SQL para inserir os dados no banco de dados
// Se houver um erro na execução, a função 'mysqli_query' irá interromper o script e exibir uma mensagem de erro
mysqli_query($conexao, $sql) or die("Erro ao executar a consulta." . mysqli_error($conexao));

// Exibe uma mensagem informando que o registro foi inserido com sucesso
echo "O registro foi inserido com sucesso.";
?>
