<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT nome, email, foto, atuacao,genero,descricao FROM perfil WHERE id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$nome = $_POST['nome'];//
		$email = $_POST['email'];//
		$atuacao= $_POST['atuacao'];// 
		$genero= $_POST['genero'];// 
		$senha= $_POST['senha'];// 
		$confirmaSenha= $_POST['confirmaSenha'];// 
		$descricao	= $_POST['descricao'];// 
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'user_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['userPic']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE perfil 
									     SET nome=:uname, 
										     email=:ujob, 
										     foto=:upic,
										     genero=:genero,
										     atuacao=:atuacao,
										     senha=:senha,
										     confirmaSenha=:confirmaSenha,
										     descricao=:descricao
								       WHERE id=:uid');
			$stmt->bindParam(':uname',$nome);
			$stmt->bindParam(':ujob',$email);
			$stmt->bindParam(':genero',$genero);
			$stmt->bindParam(':atuacao',$atuacao);
			$stmt->bindParam(':senha',$senha);
			$stmt->bindParam(':confirmaSenha',$confirmaSenha);
			$stmt->bindParam(':descricao',$descricao);
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload, Insert, Update, Delete an Image using PHP MySQL - Coding Cage</title>

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


<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Nome.</label></td>
        <td><input class="form-control" type="text" name="nome" value="<?php echo $nome; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Email</label></td>
        <td><input class="form-control" type="text" name="email" value="<?php echo $email; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Atuação</label></td>
        <td><input class="form-control" type="text" name="atuacao" value="<?php echo $atuacao; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Gênero</label></td>
        <td><input class="form-control" type="text" name="genero" value="<?php echo $genero; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Senha</label></td>
        <td><input class="form-control" type="password" name="senha" value="<?php echo $senha; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">confirma Senha</label></td>
        <td><input class="form-control" type="password" name="confirmaSenha" value="<?php echo $confirmaSenha; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Descricao</label></td>
        <td><input class="form-control" type="text" name="descricao" value="<?php echo $descricao; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Profile Img.</label></td>
        <td>
        	<p><img src="user_images/<?php echo $userPic; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="user_image" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>


<div class="alert alert-info">
    <strong>tutorial link !</strong> <a href="http://www.codingcage.com/2016/02/upload-insert-update-delete-image-using.html">Coding Cage</a>!
</div>

</div>
</body>
</html>
