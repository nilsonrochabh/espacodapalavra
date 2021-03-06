<!doctype html>
<?php
require_once 'dbconfig.php';
session_start();
$id=$_SESSION['id'];
$nome=$_SESSION['nome'];
$idpro = (int) $_GET['id'];

$stmt= $DB_con->prepare("SELECT * FROM proposicao WHERE id_proposicao = ?");
$stmt->bindValue(1,$idpro);
$stmt->execute();
if($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
    die();
}

/*if(!isset($_SESSION['logado'])):
  header("Location:./index.php");
endif;
*/

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
        <main class="proposicao">
          <div class="container">
            <div class="header-pr">

            </div>
            <div class="info-pr-1">
              <h2><?= $row['nome'];?></h2>
              <h3>Objetivos</h3>
              <p><?= $row['objetivo'];?></p>
            </div>
            <div class="info-pr-2">
              <h3>Recursos utilizados</h3>
              <img src="img/recursos-temp.jpg" />

              <h3>Duração total</h3>
              <span class="icon-clock"></span><span class="duration-time">05:20</span>
            </div>
            <div class="author-pr">
              <div class="photo-profile">
               <img src="user_images/<?php echo $row['foto']; ?>" >
              </div>
              <h2><?= $row[''];?></h2>
              <span><?php echo $id_seguida;?> Seguidores </span>
              <a href="#">Seguir</a>
            </div>
            <div id="tabs">
              <ul>
                <li class="passos"><a href="#passos">Passos</a></li>
                <li class="comentarios"><a href="#comentarios">Comentários</a></li>
              </ul>
              <div id="passos">
                <ol class="passos">
                  <li class="passo">
                    <div class="title">
                      <h4>Encontro</h4>
                      <span class="icon-clock"></span><span class="duration-time">00:20</span>
                    </div>
                    <ul class="subpassos">
                      <li class="subpasso">
                        <span class="bullet">01</span> - Peça aos alunos para levarem um retrato (foto com pessoas) que tenha um significado afetivo para eles. Não podem levar fotos 3x4, nem fotos deles mesmos.
                      </li>
                    </ul>
                  </li>
                  <li class="passo">
                    <div class="title">
                      <h4>Encontro</h4>
                      <span class="icon-clock"></span><span class="duration-time">00:40</span>
                    </div>
                    <ul class="recursos">
                      <li>Papel</li>
                      <li>Caneta</li>
                    </ul>
                    <ul class="subpassos">
                      <li class="subpasso">
                        <img src="img/passo-foto.jpg" />
                        <span class="bullet">2</span> - O professor recolhe as fotografias e coloca todas as imagens em cima de uma mesa grande para que os alunos possam vê-las.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">3</span> - Cada aluno deve escolher uma imagem. É igual amigo oculto, não vale pegar a foto que trouxe.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">4</span> -  A partir dessa escolha, cada aluno irá iniciar seu texto. Neste momento, é importante o professor explicar a atividade > ler textos de referência >
                      </li>
                      <li class="subpasso">
                        <span class="bullet">5</span> - Enquanto desenvolvem o texto, o educador deve auxiliar os alunos, ajudar a encontrá-los um tema ou o disparador para a história.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">6</span> - Os alunos devem finalizar a primeira versão do texto na aula e passar para o professor.
                      </li>
                    </ul>
                  </li>
                  <li class="passo">
                    <div class="title">
                      <h4>Encontro</h4>
                      <span class="icon-clock"></span><span class="duration-time">01:30</span>
                    </div>
                    <ul class="recursos">
                      <li>Um computador por aluno</li>
                      <li>Internet</li>
                      <li>impressora</li>
                    </ul>
                    <ul class="subpassos">
                      <li class="subpasso">
                        <span class="bullet">7</span> - O professor devolve os textos para os alunos e conversa individualmente com cada aluno. Essa conversa é um momento importante da atividade. Ela é uma orientação do trabalho, deve apontar potencialidades e fragilidades do texto bem como analisar a criatividade, as estratégias narrativas e a coerência e coesão do texto.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">8</span> - Os alunos reescrevem os textos com base na conversa com o professor. É interessante que os alunos sejam estimulados a ler o texto dos colegas e também opinar e dar sugestões.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">9</span> -  Os alunos digitam os textos. O professor deve atentar para correção ortográfica (aprender a usar corretores online e dicionários) e para a formatação do texto: título, assinatura, parágrafos, espaçamento e margens.
                      </li>
                      <li class="subpasso">
                        <span class="bullet">10</span> - Todos os textos devem ser enviados para  o e-mail do professor.
                      </li>

                      <li class="subpasso obs">
                        PROFESSOR deve fazer uma última revisão ortográfica nos textos<br /> e imprimi-los em folha A4.
                      </li>


                    </ul>

                  </li>

                </ol>
              </div>
              <div id="comentarios">
                <div class="comment-post">
                  <div class="comment-profile">
                    <div class="comment-user-photo">
                      <img src="img/profile-author.jpg" />
                    </div>
                    <h4>Flavia Peret</h4>
                  </div>
                  <div class="comment-box">
                    <textarea></textarea>
                    <div class="comment-options">
                      <p class="comment-policy">
                        Temos uma política de gentileza.<br />
                        Por favor seja positivo e construtivo.
                      </p>
                      
                      <input type="submit" value="ENVIAR"/>
                      <a href="#" class="add-photo-comment">
                        <img src="img/add-photo-comment.jpg" />
                      </a>
                    </div>
                  </div>
                </div>
                <div class="comment-posted">
                  <div class="comment-profile">
                    <div class="comment-user-photo">
                      <img src="img/profile-author.jpg" />
                    </div>
                    <h4>Flavia Peret</h4>
                  </div>
                  <div class="comment-box">
                    <p class="comment-text">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    </p>
                    <div class="comment-options">
                      <input type="submit" value="RESPONDER"/>
                    </div>
                  </div>
                </div>
                <div class="comment-posted">
                  <div class="comment-profile">
                    <div class="comment-user-photo">
                      <img src="img/profile-author.jpg" />
                    </div>
                    <h4>Flavia Peret</h4>
                  </div>
                  <div class="comment-box">
                    <p class="comment-text">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    </p>
                    <div class="comment-options">
                      <input type="submit" value="RESPONDER"/>
                    </div>
                  </div>
                </div>
                <div class="comment-posted">
                  <div class="comment-profile">
                    <div class="comment-user-photo">
                      <img src="img/profile-author.jpg" />
                    </div>
                    <h4>Flavia Peret</h4>
                  </div>
                  <div class="comment-box">
                    <p class="comment-text">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    </p>
                    <div class="comment-options">
                      <input type="submit" value="RESPONDER"/>
                    </div>
                  </div>
                </div>
                <div class="comment-posted">
                  <div class="comment-profile">
                    <div class="comment-user-photo">
                      <img src="img/profile-author.jpg" />
                    </div>
                    <h4>Flavia Peret</h4>
                  </div>
                  <div class="comment-box">
                    <p class="comment-text">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                    </p>
                    <div class="comment-options">
                      <input type="submit" value="RESPONDER"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
               <h3>memoria inventada</h3>
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
