<!doctype html>

<?php
require_once 'dbconfig.php';
session_start();
$id_perfil=$_SESSION['id'];
$nome_perfil=$_SESSION['nome'];


?>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Espaço da Palavra</title>
        <meta description="ESPAÇO DA PALAVRA é uma plataforma colaborativa que reúne práticas pedagógicas em escrita. Queremos conhecer, dar visibilidade e sistematizar experiências, projetos e metodologias que aproximam a escrita do universo de jovens estudantes.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="styles/plugins.css">
        <link rel="stylesheet" href="styles/styles.css">

    </head>
    <body>
        <header>
          <div class="container">
            <div class="logo">
              <h1>
                <img src="img/espaco-da-palavra.svg" alt="Espaço da Palavra (Logo)" />
              </h1>
            </div>
            <div class="menu">
             <div class="menu">
              <div class="login">
			  <?php 
			  if(isset($_SESSION["logado"])): 
			  ?>
			  <?php
					    echo "<a href='ver.php?id=".$id_perfil."'<span class='icon-profile'>" .$nome_perfil."</span> </a>";
						
					  
					  
						echo"<div class='menu'>";
					  echo "<div class='login'>";
						echo "<a href='./class/logout.php'>";
						  echo "<span></span> <span class='text-login'>Sair</span>";
						echo "</a>";
				echo "</div>";
			else:
					echo "<div class='login'>";
                echo "<a href='./login.html'>";
                  echo "<span class='icon-profile'></span> <span class='text-login'>Acessar ou cadastrar</span>";
                echo "</a>";
              echo"</div>";
			  endif;
			  
			?>
                <div class="menu-itens">
                <ul>
                  <li class="conheca">
                    <a href="#" id="call-conheca">
                      Conheça
                    </a>
                  </li>
                  <li class="explore">
                    <a href="#" id="call-explore">
                      Explore
                    </a>
                  </li>
    			<?php               
                  echo "<li class='publique'>";
	
				if(isset($_SESSION["logado"]))	{  
                    echo "<a href='publique.php'>";
                     echo " Publique";
                    echo "</a>";
                    echo"</li>";
				}else
				{
					  echo "<a href='login.html'>";
                     echo " Publique";
                    echo "</a>";
                    echo"</li>";
					}
				
				
                    ?>
                 
                </ul>
              </div>
              <div class="sub-menu" id="sub-menu">
                <div class="menu-conheca">
                  <ul>
                    <li class="o-que-e">
                      <a class="inline" href="#o-que-e-box">
                        O que é?
                      </a>
                    </li>
                    <li class="como-funciona">
                      <a class="inline" href="#como-funciona-box">
                        Como funciona
                      </a>
                    </li>
                    <li class="porque">
                      <a class="inline" href="#porque-box">
                        Por quê?
                      </a>
                    </li>
                    <li class="metodologias">
                      <a href="metodologias.html">
                        Metodologias
                      </a>
                    </li>
                    <li class="quem-faz">
                      <a class="inline" href="#quem-faz-box">
                        Quem faz
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="sub-menu-explore" id="sub-menu-explore">
                <div class="menu-conheca">
                  <ul>
                    <li class="como-funciona">
                      <a href="proposicoes.php">
                        Proposições
                      </a>
                    </li>
                    <li class="porque">
                      <a href="explore-artistas.html">
                        Artistas
                      </a>
                    </li>
                    <li class="quem-faz">
                      <a href="explore-leitura.html">
                        Leitura
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </header>
        <main class="home">
			
			     
          <div class="container">
        
            <div class="container">
        
            <ul>
               <?php
                 require_once 'dbconfig.php';
                  $stmt= $DB_con->prepare("SELECT * FROM proposicao");
                  $stmt->execute();
                   if($stmt->rowCount() > 0)
                  {
                      $i = 0;
                     while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                  {
                  extract($row);
                      $data[] = $row;

                  ?>

              <a class="inline item-category" data-category="sensibilizacao" href="#inline_content<?= $i;?>">
                <li>
                 <h2><?php echo $nome;?></h2>
                  <div class="thumb">
                    <div class="hover-info">
                      <ul>
                        <li>
                          <div class="icon">
                            <span class="icon-heart">
                            </span>
                          </div>
                          <div class="info">
                            <span class="number">
                              <?php  echo $id_curtida; ?>
                            </span>
                            <span class="text">
                              curtidas
                            </span>
                          </div>
                        </li>
                        <li>
                          <div class="icon">
                            <span class="icon-check">
                            </span>
                          </div>
                          <div class="info">
                            <span class="number">
                              <?php  echo $id_fizeram; ?>
                            </span>
                            <span class="text">
                              fizeram
                            </span>
                          </div>
                        </li>
                        <li>
                          <div class="icon">
                            <span class="icon-chat">
                            </span>
                          </div>
                          <div class="info">
                            <span class="number">
                              <?php  echo $id_comentario; ?>
                            </span>
                            <span class="text">
                              comentários
                            </span>
                          </div>
                        </li>
                        <li>
                          <!--<div class="icon">
                            <span class="icon-anchor">
                            </span>
                          </div>
                          <div class="info">
                            <span class="number">
                            
                           <!-- </span>
                            <span class="text">
                              seguidores
                            </span>
                          </div>-->
                        </li>
                      </ul>
                    </div>
                    <img src="img/thumbs/01.jpg" />
                  </div>
                </li>

              </a>
                <?php
                      $i++;
                 }
              }?>

            </ul>
            

          </div>
                 </main>
        <footer>
          <div class="container">
            <img src="img/footer-creditos.jpg" class="creditos" />
            <ul>
              <li>
                <a href="#">
                  Contato
                </a>
              </li>
              <li>
                <a href="#">
                  Política de privacidade
                </a>
              </li>
              <li>
                <a href="#">
                  Termos de uso
                </a>
              </li>
            </ul>
          </div>
        </footer>
        <div style='display:none'>
            <?php
                foreach($data as $a=>$b){

            ?>

    			<div id='inline_content<?= $a; ?>' class="modal-box">
    			     <img src="img/modal-header.jpg" />
               <h3><?= $b['nome'];?></h3>
               <p><?= $b['descricao'];?></p>
                <a href="proposicao.php?id=<?= $b['id_proposicao'];?>" class="abrir">
                  ABRIR
                </a>
           	</div>
            <?php
       }
       ?>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-72765846-1', 'auto');
            ga('send', 'pageview');

        </script>
        
    </body>
</html>
