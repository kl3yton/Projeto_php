<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'agenda_telefonica';

// Conecta ao servidor de banco de dados
$conexao = new mysqli($host, $user, $password);

// Verifica se a conexão foi bem-sucedida
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Cria o banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conexao->query($sql) === TRUE) {
    // Seleciona o banco de dados
    $conexao->select_db($dbname);

    // Cria a tabela tb_contato se não existir
    $sql = "CREATE TABLE IF NOT EXISTS tb_contato (
        idContato INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nomeContato VARCHAR(200) NOT NULL,
        emailContato VARCHAR(100) NOT NULL,
        telefoneContato VARCHAR(50) NOT NULL,
        enderecoContato VARCHAR(200) NOT NULL,
        data_nasc_Contato DATE NOT NULL
    )";
    
    if ($conexao->query($sql) === FALSE) {
        die("Erro na criação da tabela tb_contato: " . $conexao->error);
    }

    // Cria a tabela tb_usuarios se não existir
    $sql = "CREATE TABLE IF NOT EXISTS tb_usuarios (
        loginUser VARCHAR(45) NOT NULL,
        senhaUser VARCHAR(64) NOT NULL,
        nomeUser VARCHAR(45) NOT NULL,
        PRIMARY KEY (loginUser)
    )";

    if ($conexao->query($sql) === FALSE) {
        die("Erro na criação da tabela tb_usuarios: " . $conexao->error);
    }

} else {
    die("Erro ao criar banco de dados: " . $conexao->error);
}


?>
