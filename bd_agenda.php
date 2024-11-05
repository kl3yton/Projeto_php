<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'agenda_telefonica';

$conexao = new mysqli($host, $user, $password);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Cria o banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conexao->query($sql) === TRUE) {
    $conexao->select_db($dbname);
    
    // Cria a tabela se não existir
    $sql = "CREATE TABLE IF NOT EXISTS tb_contato(
        idcontato INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nomeContato VARCHAR(200) NOT NULL,
        emailCotato VARCHAR(100) NOT NULL,
        telefoneContato VARCHAR(50) NOT NULL,
        data_nasc_Cotato DATE NOT NULL,
        tagFavorito TINYINT(1) DEFAULT NULL
    )";

    if ($conexao->query($sql) === FALSE) {
        die("Erro na criação da tabela: " . $conexao->error);
    } else {
        echo "Banco de dados e tabela criados com sucesso!";
    }
} else {
    die("Erro ao criar banco de dados: " . $conexao->error);
}

$conexao->close();
?>
