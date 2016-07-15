<?php
session_start();
	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$nome = $_POST['nome'];// 
		$email = $_POST['email'];// 
		$atuacao = $_POST['atuacao'];// 
		$genero = $_POST['genero'];// 
		$senha = MD5($_POST['senha']);//
		$confirmaSenha = MD5($_POST['confirmaSenha']);//
		$descricao = $_POST['descricao'];// 
			
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];

		
		if(empty($nome)){
			$errMSG = "Por favor informe seu nome.";
		}
		else if(empty($email)){
			$errMSG = "Por favor informe seu email.";
		}
		else
		{
			$upload_dir = 'user_images/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
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
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO perfil(
				nome,
				email,
				foto,
				atuacao,
				genero,
				senha,
				confirmaSenha,
				descricao,
				data) 
			VALUES(
			:nome, 
			:email, 
			:upic,
			:atuacao,
			:genero,
			:senha,
			:confirmaSenha,
			:descricao,
			NOW())');
			$stmt->bindParam(':nome',$nome);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':senha',$senha);
			$stmt->bindParam(':genero',$genero);
			$stmt->bindParam(':atuacao',$atuacao);
			$stmt->bindParam(':confirmaSenha',$confirmaSenha);
			$stmt->bindParam(':descricao',$descricao);
			$stmt->bindParam(':upic',$userpic);


		   //validando
		  $valida=$DB_con->prepare("SELECT * FROM  perfil WHERE  email=?");
		  $valida->execute(array($email));
	     if($valida->rowCount()==0):
	     	$stmt->execute();
	     	$successMSG = "new record succesfully inserted ...";
	    	header("Location:index.php");
	     else:
		     $errMSG = "Email já cadastrado....";
		// 	echo" <br /><a href='./index.php'>Voltar</a>";
	     endif;	
			
		
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastre-se</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body>

<header>
          <div class="container">
            <div class="logo login">
              <h1>
                <a href="index.php"><img src="img/espaco-da-palavra.svg" alt="Espaço da Palavra (Logo)" /></a>
              </h1>
            </div>

          </div>
        </header>

<div class="container">
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Nome.</label></td>
        <td><input class="form-control" type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">email.</label></td>
        <td><input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Foto.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    		 <tr>
    	<td><label class="control-label">Atuação</label></td>
        <td><input class="form-control" type="text" name="atuacao" placeholder="Atuacao" value="<?php echo $atuacao; ?>" /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Gênero.</label></td>
        <td><input class="form-control" type="text" name="genero" placeholder="Gênero" value="<?php echo $genero; ?>" /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Senha</label></td>
        <td><input class="form-control" type="password" name="senha" placeholder="Senha" value="<?php echo $senha; ?>" /></td>
    </tr>
       <tr>
    	<td><label class="control-label">Confirma Senha</label></td>
        <td><input class="form-control" type="password" name="confirmaSenha" placeholder="Confirma Senha" value="<?php echo $confirmaSenha; ?>" /></td>
    </tr>
      <tr>
    	<td><label class="control-label">Sobre Você</label></td>
        <td><input class="form-control" type="text" name="descricao" placeholder="Sobre Você" value="<?php echo $descricao; ?>" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Salvar
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
