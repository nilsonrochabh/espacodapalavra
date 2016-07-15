<?php
include("conexao.php");
$pdo=conectar();

//verifica se exite os dados necessarios para a deletar

if(!empty($_GET["id"])):

	//recebendo dados
	$id=addslashes(trim($_GET["id"]));
	//deletando usario
	$deletartUsuario=$pdo->prepare("DELETE FROM perfil WHERE id=?" );
	$deletartUsuario=$pdo->bindValue(1,$id);
	$deletartUsuario=$pdo->execute();
	if($deletartUsuario->rowCont()>0):
		echo "USUARIO DELETADO COM SUCESSO!";
	else:
		echo "Desculpe, usuario não encontrado";
	endif;
else:
	echo "<h2> Nenhum usuario encontrado</h2>";
endif;
?>
