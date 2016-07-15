<html>
	<head>
		 <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Visualiza dados</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../styles/plugins.css">
        <link rel="stylesheet" href="../styles/styles.css">
	</head>
	<body>

			</body>
			        <header>
          <div class="container">
            <div class="logo login">
              <h1>
                <a href="./index.php"><img src="./img/espaco-da-palavra.svg" alt="Espaço da Palavra (Logo)" /></a>
              </h1>
            </div>

          </div>
        </header>
        <main class="login">
          <div class="container">
            <div class="col-full">
<div class="span10 offset1">
                    <div class="row">
                        <h3>Meus Dados</h3>
                    </div>

<?php

	require_once 'dbconfig.php';
	
	if(isset($_GET['id']))
	
	{
	//$id = addslashes(trim($_GET['id']));
	$id=(int)$_GET['id'];
	$stmt= $DB_con->prepare("SELECT * FROM perfil WHERE id =:id");
	$stmt->bindValue(":id",$id);
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			          
                      
                      
						 <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Nome </label>
                        <div class="controls">
							<label><?php echo $nome;?></label>
                                                                        
                        </div>
                      </div>
                      </div>
                 
                 
                                
                 
                    
						  <div class="artista-galeria">
						  <div class="palco-galeria">
						  <img src="user_images/<?php echo $row['foto']; ?>" class="img-rounded" width="250px" height="250px" />
                        </div>
                        </div>
                      	  
                      
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            
                                <?php echo $email;?>
                            
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Atuacao</label>
                        <div class="controls">
                         
                                <?php echo $atuacao;?>
                            
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Genero</label>
                        <?php echo $genero;?>
                        <div class="controls">
                          
                                
                          
                        </div>
                      </div>
                      
                      
                      <div class="control-group">
                        <label class="control-label">Descricao</label>
                        <div class="controls">
                       
                                <?php echo $descricao;?>
                           
                        </div>
                      </div>
                      
                      
                      
                      
                      
			
			
				<span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['id']; ?>" title="click for edit" onclick="return confirm('Deseja editar seus dados?')"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
				</span>
				</p>
			
			<?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
		
}

?>

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
