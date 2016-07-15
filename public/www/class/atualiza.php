<?php
//conexao
include("conexao.php");
$pdo=conectar();
//recebendo dados
$nome=addslashes(trim($_POST['nome']));
$email=addslashes(trim($_POST['email']));
$atuacao=addslashes(trim($_POST['atuacao']));
$genero=addslashes(trim($_POST['genero']));
$senha=addslashes(trim($_POST['senha']));
$confirmaSenha=addslashes(trim($_POST['confirmaSenha']));
$descricao=addslashes(trim($_POST['descricao']));
$id=addslashes(trim($_GET['id']));

$atualizaDados=pdo->prepare("UPDADE perfil SET nome:nome, email:email,atuacao:atuacao,")

?>
