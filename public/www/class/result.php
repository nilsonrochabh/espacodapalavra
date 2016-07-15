<?php
session_start();
include 'conexao.php';
$pdo=conectar();
$buscarUsuario= $pdo->prepare("SELECT * FROM perfil WHERE nome LIKE '%".$busca."%'" );
$buscarUsuario->execute();
$linha = $buscarUsuario->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Resultado de pesquisa </title>
</head>
<body>

<?php  
$busca=$_POST['busca'];

?>
</body>
</html>
