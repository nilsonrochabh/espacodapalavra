<?php
include("conexao.php");
	$pdo=conectar();
	$nome=$_POST["nome"];
	$email=$_POST["email"];
	$atuacao=$_POST["atuacao"];
	$genero=$_POST["genero"];
	$senha=$_POST["senha"];
	$confirmaSenha=$_POST["confirmaSenha"];
	$descricao=$_POST["descricao"];
	
		$imgFile = $_FILES['foto']['name'];
		$tmp_dir = $_FILES['foto']['tmp_name'];
		$imgSize = $_FILES['foto']['size'];
		
			//$upload_dir = 'img/'; // upload directory
			$upload_dir = 'user_images/'; // upload directory
	
			//$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			//$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			//$userpic = rand(1000,1000000).".".$imgExt;
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
	//cadastrando
	$insertseguro=$pdo->prepare("INSERT INTO perfil (nome,email,foto,atuacao,genero,senha,confirmaSenha,descricao,data)
	VALUES(:nome,:email,:foto,:atuacao,:genero,:senha,:confirmaSenha,:descricao,NOW())");
	
	$insertseguro->bindValue(":nome",$nome);
	$insertseguro->bindParam(":foto",$userpic);
	$insertseguro->bindValue(":email",$email);
	$insertseguro->bindValue(":atuacao",$atuacao);
	$insertseguro->bindValue(":genero",$genero);
	$insertseguro->bindValue(":senha",$senha);
	$insertseguro->bindValue(":confirmaSenha",$confirmaSenha);
	$insertseguro->bindValue(":descricao",$descricao);
	
	//validando
	$valida=$pdo->prepare("SELECT * FROM  perfil WHERE  email=?");
	$valida->execute(array($email));
	if($valida->rowCount()==0):
		$insertseguro->execute();
		header("Location: ../index.php");
	else:
		echo "email já cadastrado";
		echo" <br /><a href='../cadastre.html'>Voltar</a>";
	endif;
	
?>
