<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'agenda_telefonica';

$conexao = new mysqli($host, $user, $password, $dbname);

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
        emailContato VARCHAR(100) NOT NULL,
        telefoneContato VARCHAR(50) NOT NULL,
        data_nasc_Contato DATE NOT NULL,
        tagFavorito TINYINT(1) DEFAULT NULL
    )";

    if ($conexao->query($sql) === FALSE) {
        die("Erro na criação da tabela: " . $conexao->error);
    } 
    // A linha de sucesso foi removida
} else {
    die("Erro ao criar banco de dados: " . $conexao->error);
}   

?>
