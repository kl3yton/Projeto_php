<header>
    <!-- Cabeçalho da página para exclusão de contato, com ícone de lixeira -->
    <h3><i class="bi bi-trash"></i> Excluir Contato</h3>
</header>

<?php 
// Recebe o ID do contato a ser excluído via parâmetro GET, e usa 'mysqli_real_escape_string' para prevenir SQL Injection
$idContato = mysqli_real_escape_string($conexao, $_GET["idContato"]);

// Comando SQL para excluir o registro da tabela 'tb_contato' com o ID correspondente
$sql = "DELETE FROM tb_contato WHERE idContato= '{$idContato}'";

// Executa a consulta SQL para excluir o registro do banco de dados
// Caso haja um erro, a função 'mysqli_query' interrompe o script e exibe uma mensagem de erro
mysqli_query($conexao, $sql) or die("Erro ao excluir o registro. ". mysqli_error($conexao));

// Exibe uma mensagem informando que o registro foi excluído com sucesso
echo "Registro excluído com sucesso!";
?>
