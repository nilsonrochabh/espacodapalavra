<?php
include("conexao.php");
$pdo=conectar();

//inicio da trasacao
$pdo->beginTransaction();
$login=$pdo->query("INSERT INTO login(email, senha) VALUES ('jose@terra.com.br','123456')");
if(!$login){
	die("houve um erro no cadastro do login");
	}
//cadastro final
$perfil=$pdo->query("INSERT INTO perfil (nome,foto,email,atuacao,genero,senha,confirmaSenha,cep,cidade,estado,descricao) 
		VALUES('nilson','x','nilson@gmail.com','prof','maculino','1234','1234','33200000','vespasiano','mg','bla bla bla')");
		if(!$perfil){
			$pdo->rollBack();
			die("houve um erro no cadastro do perfil");
			}
		//confirma transacao
		$pdo->commit();	
?>
