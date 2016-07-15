<?php
session_start();
include 'conexao.php';
$pdo=conectar();
	if(isset($_GET['id']) && !empty($_GET['id'])):
		$id = $_GET['id'];
		$stmt_edit = $pdo->prepare('SELECT nome, email, foto,atuacao,genero,senha,confirmaSenha,descricao FROM perfil WHERE id =:id');
		$stmt_edit->execute(array(':id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	
	else:
		header("Location: ../index.php");
	endif;
	
	if(isset($_POST['atualizar']))
	{
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$atuacao = $_POST['atuacao'];
		$genero = $_POST['genero'];
		$senha= $_POST['senha'];
		$confirmaSenha = $_POST['confirmaSenha'];
		$descricao = $_POST['descricao'];		
		
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
			$stmt = $pdo->prepare('UPDATE perfil 
									     SET nome=:nome, 
										     email=:email, 
										     atuacao=:atuacao,
										     geneto=:genero,
										     senha=:senha,
										     confirmaSenha=:confirmaSenha,
										     descricao=:descricao;
										     foto=:upic 
								       WHERE id=:id');
			$stmt->bindParam(':nome',$nome);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':atuacao',$atuacao);
			$stmt->bindParam(':genero',$genero);
			$stmt->bindParam(':senha',$senha);
			$stmt->bindParam(':confirmaSenha',$confirmaSenha);
			$stmt->bindParam(':descricao',$descricao);
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':id',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='../index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>

        <header>
          <div class="container">
            <div class="logo login">
              <h1>
                <a href="../index.php"><img src="../img/espaco-da-palavra.svg" alt="Espaço da Palavra (Logo)" /></a>
              </h1>
            </div>

          </div>
        </header>
        <main class="login">
          <div class="container">
            <div class="col-full">
                    <div class="row">
                        <h3>Atualizar</h3>
                    </div>
	<body>

			</body>
			
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Nome </label>
                        <div class="controls">
							<input type="text" nome="nome" value= "<?php echo $nome;?>" />
                           
                               
                            
                        </div>
                      </div>
                      <div class="form-horizontal" >
						  <div class="control-group">
							  <label class="control-label">Foto</label>
							  <div class="controls">
								  <img src="user_images/<?php echo $userPic; ?>" height="150" width="150" /></p>
								<input class="input-group" type="file" name="user_image" accept="image/*" />
								</div>
							</div>
						</>	
                      
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            
                            <input type="text" nome="email" value= "<?php echo $email;?>" />
                            
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Atuacao</label>
                        <div class="controls">
                         
                               <input type="text" nome="atuacao" value= "<?php echo $atuacao;?>" />
                            
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Genero</label>
                        <div class="controls">
							<input type="text" nome="genero" value= "<?php echo $Genero;?>" />
                        </div>
                      </div>
                                          
                      <div class="control-group">
                        <label class="control-label">Descricao</label>
                        <div class="controls">
						<input type="text" nome="descricao" value= "<?php echo $descricao;?>" />     
                        </div>
                      </div>
                         <div class="form-actions">
                        <button type="submit" name="atualizar" class="btn btn-default">
								<span class="glyphicon glyphicon-save"></span> Atualizar
						</button>
                       </div>
                        <div class="form-actions">
                         <a href="../index.php"><input type="submit" value="Voltar" name="voltar"></a>
                       </div>
                    
                     
                      
                    </div>
                </div>

          </div>
        </main>

  <script src="../js/plugins.js"></script>
        <script src="../js/app.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-72765846-1', 'auto');
            ga('send', 'pageview');

        </script>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
        <script>
          tinymce.init({
            selector: '#proposicao-conteudo',
            menubar:false,
            plugins: [
               "advlist autolink lists link image charmap print preview anchor",
               "searchreplace visualblocks code fullscreen",
               "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            automatic_uploads: true
          });
        </script>
</body>
</html>
