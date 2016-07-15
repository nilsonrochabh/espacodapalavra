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
                <a href="index.html"><img src="img/espaco-da-palavra.svg" alt="Espaço da Palavra (Logo)" /></a>
              </h1>
            </div>
            <div class="menu">
              <div class="login">
                <?php 
        if(isset($_SESSION["logado"])): 
        ?>
        <?php
              echo "<a href='ver.php?id=".$id."'<span class='icon-profile'>" .$nome."</span> </a>";
            
            
            
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
                    if(isset($_SESSION["logado"]))  {  
                    echo "<a href='publique.php'>";
                     echo " Publique";
                    echo "</a>";
        }
                    ?>
                  </li>
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
                      <a href="explore-proposicoes.html">
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
        <aside class="filterbox">
          <div class="filter-full">
            <div class="content-filter">
              <ul>
                <li>
                  <a href="#" class="applyfilter" data-filter="sensibilizacao">
                    Sensibilização
                  </a>
                </li>
                <li>
                  <a href="#" class="applyfilter" data-filter="jogos">
                    Jogos
                  </a>
                </li>
                <li>
                  <a href="#" class="applyfilter" data-filter="parte-escrita">
                    Parte Escrita
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </aside>
        <main class="home">
          <div class="container">

            <ul>
              <?php
                $stmt= $DB_con->prepare("SELECT * FROM proposicao");
                $stmt->execute();
                if($stmt->rowCount() > 0)
                {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                extract($row);
              ?>
              <a class="inline item-category" data-category="parte-escrita" href="#inline_content">
                  <h2><?php echo $nome; ?></h2> 
                              
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
                            <?php echo $curtida.['id_curtida'];?>
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
                              <?php echo $fizeram.['id_fizeram'];?>
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
                              <?php echo $comentarios.['id_comentario'];?>
                            </span>
                            <span class="text">
                              comentários
                            </span>
                          </div>
                        </li>
                        <li>
                          <div class="icon">
                            <span class="icon-anchor">
                            </span>
                          </div>
                          <div class="info">
                            <span class="number">
                              03
                            </span>
                            <span class="text">
                              seguidores
                            </span>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <img src="img/thumbs/01.jpg" />
                  </div>
                </li>
              </a>
            <?php
             }
           }
         ?>

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
    			<div id='inline_content' class="modal-box">
    			     <img src="img/modal-header.jpg" />
               <h3><?php? echo $nome;?></h3>
               <p>Tudo que não invento é falso, escreveu Manoel de Barros.
                 Para o poeta, a memória (assim como a criação literária) é uma invenção.
                 A partir dessa ideia os alunos vão desenvolver pequenas histórias para
                 as memórias dos colegas a partir de fotografias do acervo familiar e
                 afetivo de cada aluno.  A fotografia é o disparador do texto.
                 É ela que irá fornece os elementos (personagens, espaços, objetos) que
                 fazem a imaginação do escritor inventar.</p>
                <a href="proposicao.html" class="abrir">
                  ABRIR
                </a>
    			</div>
          <div id='o-que-e-box' class="modal-box">
               <img src="img/o-que-e-cover.jpg" />
               <h3>O que é?</h3>
               <p>ESPAÇO DA PALAVRA é uma plataforma colaborativa que reúne práticas pedagógicas em escrita. Queremos conhecer, dar visibilidade e sistematizar experiências, projetos e metodologias que aproximam a escrita do universo de jovens estudantes.
               <br /><br />
               Através da escrita podemos construir e trocar experiências, criando outros modos de ser e de estar no mundo. A escrita é uma habilidade essencial para o desenvolvimento de potencialidades. Ela amplia nossa capacidade de perceber a realidade que nos cerca e interagir com ela de forma mais crítica e ativa.
               <br /><br />
               Neste site, você não encontrará conteúdos relacionados ao ensino formal da língua portuguesa (aulas de gramática ou aulas de história da literatura, por exemplo). A proposta do ESPAÇO DA PALAVRA é incentivar o desenvolvimento de práticas que apostam na criatividade, na inovação e no risco. Já que escrever é arriscar-se. É abrir-se para um processo intenso de descobertas e de incertezas, mas também de transformações profundas em nossa maneira de perceber e interagir com o mundo.</p>
          </div>
          <div id='como-funciona-box' class="modal-box">
               <img src="img/como-funciona-cover.jpg" />
               <h3>como funciona?</h3>
               <p>Os professores podem publicar e compartilhar suas práticas pedagógicas, trocar informações com outros professores – formando redes e comunidades de aprendizado específicas – e conversar sobre os desafios e inquietações inerentes à prática em sala de aula.
               <br /><br />
               Para participar, acesse a seção <a href="publique.html">PUBLIQUE</a>.</p>
          </div>
          <div id='porque-box' class="modal-box">
               <img src="img/porque-cover.jpg" />
               <h3>Por que?</h3>
              <p>Estimular jovens estudantes a escrever, apropriando-se da linguagem de forma consciente, ativa e criativa é um grande desafio. Escrever é uma ação reflexiva, um ato de comunicação e de expressão. Escrever é uma forma de ocupar o mundo. Ou melhor, é uma forma de criar no mundo um espaço para nossas ideias e, a partir dessa ocupação, conviver com outras formas de ser e de pensar.
              <br /><br />
              Acreditamos que a escrita é um dispositivo capaz de transformar as pessoas. A partir do momento em que escrevem, elas tornam-se mais conscientes de si, dos outros e do lugar em que vivem. Acreditamos que todas as pessoas deveriam ter acesso a essa prática. Uma prática que é ação, reflexão, técnica, aprendizado e conhecimento.  Escrevemos para nos comunicar. Escrevemos porque existem outras pessoas interessadas em conhecer nosso universo simbólico e interagir com ele. Escrita é diálogo e diálogo gera convivência, conhecimento e solidariedade.
              <br /><br />
              Mas os espaços destinados à escrita – uma escrita viva, feita de incertezas e não apenas de certezas – são restritos. O ESPAÇO DA PALAVRA acredita que é importante incentivar educadores e estudantes a construírem coletivamente espaços para a existência e a resistência de outras formas de escrita. 
              </p>
          </div>
          <div id='quem-faz-box' class="modal-box">
              <h3>Quem faz?</h3>
              <img src="img/quemfaz-placeholder.jpg" class="img-centered" />
          </div>
    		</div>
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
