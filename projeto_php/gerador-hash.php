<?php
//gerador de senha para o formulário de login.php
// Armazena a senha original
$senha = "abcde";

// Cria um hash SHA-256 da senha
$senhaCriptografada = hash('sha256', $senha);

// Exibe a senha original e a senha criptografada
echo "Senha original: " . $senha . "<br>";
echo "Senha criptografada: " . $senhaCriptografada;
?>