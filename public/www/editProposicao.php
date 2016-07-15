<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT 
					  nome,
                      foto,
                      objetivo,
                      inicio,
                      titulo,
                      descricao,
                      duracao,
                      material,
                      sensibilidade,
                      jogo,
                      pratica_escrita,
                      coesao_coerencia,
                      tempos_verbais,
                      revisao_texto,
                      revisao_edicao,
                      vocabulario,
                      espaco_aberto,
                      sala_aula,
                      comp, 
                      comp_aluno,
                      papelaria,
                      projetor,
                      cel_internet,
                      cinco,
                      dez,
                      quinze,
                      vinte,
                      trinta,
                      trinta_um
		 FROM proposicao WHERE id =:uid');
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
			$stmt = $DB_con->prepare('UPDATE proposicao 
									     SET nome:par_nome,
											foto:upic,
											objetivo:par_objetivo,
											inicio:par_inicio,
											titulo:par_titulo,
											descricao:par_descricao,
											duracao:par_duracao,
											material:par_material,
											sensibilidade:par_sensibilidade,
											jogo:par_jogo
											pratica_escrita:par_pratica_escrita,
											coesao_coerencia:par_coesao_coerencia,
											tempos_verbais:par_tempos_verbais,
											revisao_texto:par_revisao_edicao,
											revisao_edicao:par_revisao_texto,
											vocabulario:par_vocabulario,
											espaco_aberto:par_espaco_aberto,
											sala_aula:par_sala_aula,
											comp:par_comp,
											comp_aluno:par_comp_aluno,
											papelaria:par_papelaria,
											projetor:par_projetor,
											cel_internet:par_cel_internet,
											cinco:par_cinco,
											dez:par_dez,
											quinze:par_quinze,
											vinte:par_vinte,
											trinta:par_trinta,
											trinta_um:par_trinta_um
								       WHERE id=:uid');	
	 $stmt->bindParam(':par_id_perfil',$id_usuario); 
     $stmt->bindParam(':par_nome',$nome);
     $stmt->bindParam(':upic',$userpic);
     $stmt->bindParam(':par_objetivo',    $objetivo);
     $stmt->bindParam(':par_inicio',     $inicio);
     $stmt->bindParam(':par_titulo',     $titulo);
     $stmt->bindParam(':par_descricao',     $descricao);
     $stmt->bindParam(':par_duracao',     $duracao);
     $stmt->bindParam(':par_material',     $material);

    $stmt->bindParam(':par_sensibilidade',     $values['sensibilidade']);
    $stmt->bindParam(':par_jogo',     $values['jogo']);
    $stmt->bindParam(':par_pratica_escrita',     $values['pratica_escrita']);

    $stmt->bindParam(':par_coesao_coerencia',     $values['coesao_coerencia']);
    $stmt->bindParam(':par_tempos_verbais',      $values['tempos_verbais']);
    $stmt->bindParam(':par_revisao_edicao', $values['revisao_texto']);
    $stmt->bindParam(':par_revisao_texto',     $values['revisao_edicao']);
    $stmt->bindParam(':par_vocabulario', $values['vocabulario']);
    $stmt->bindParam(':par_espaco_aberto', $values['espaco_aberto']);
    $stmt->bindParam(':par_sala_aula', $values['sala_aula']);
    $stmt->bindParam(':par_comp', $values['comp']);
    $stmt->bindParam(':par_comp_aluno', $values['comp_aluno']);
    $stmt->bindParam(':par_papelaria', $values['papelaria']);
    $stmt->bindParam(':par_projetor', $values['projetor']);
    $stmt->bindParam(':par_cel_internet', $values['cel_internet']);
    $stmt->bindParam(':par_cinco', $values['cinco']);
    $stmt->bindParam(':par_dez', $values['dez']);
    $stmt->bindParam(':par_quinze', $values['quinze']);
    $stmt->bindParam(':par_vinte', $values['vinte']);
    $stmt->bindParam(':par_trinta', $values['trinta']);
    $stmt->bindParam(':par_trinta_um', $values['trinta_um']);

    $stmt->execute();
	catch(PDOException $e) { echo 'Connection failed: ' . $e->getMessage(); }
      
            else
      {  echo 'Nada foi selecionado'; }
   } // End of, if statement from the button check


?>

<!doctype html>
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
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
        <main class="publique">
          <div class="steps-publish">
            <ul>
              <li id="stepitem1" class="steps-item ativo">Passo 01 - Informações</li>
              <li id="stepitem2" class="steps-item">Passo 02 - Montagem</li>
              <li id="stepitem3" class="steps-item">Passo 03 - Categorização</li>
            </ul>
          </div>
          <form action=""<?php echo $_SERVER['PHP_SELF']; ?>"" class="form-publique" method="POST">
            <div id="formstep1">

              <label for="nome">Nome</label>
              <span class="desc">Dê um nome para sua proposição que torne fácil entender o que ela é: (evite nomes como "a aula do século" ou "minha aula")</span>
              <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>">
            
				    	<label class="control-label">Imagem da Proposição</label>
				    	<p><img src="user_images/<?php echo $userPic; ?>" height="150" width="150" /></p>
        		  <input class="input-group" type="file" name="user_image" accept="image/*" />
    
              <label for="objetivo">Objetivo</label>
              <span class="desc">Quais são seus objetivos pedagógicos com essa proposição? (o que quer alcançar com os estudantes?)</span>
              <textarea id="objetivo" name="objetivo" value="<?php echo $objetivo; ?>"></textarea>

              <label for="start">Start</label>
              <span class="desc">Explique como ela começa: (como você provocará uma inquietação nos estudantes?)</span>
              <textarea id="start" name="inicio" value="<?php echo $inicio; ?>"></textarea>

              <a href="#" id="next2" class="button-next">
                Próximo
              </a>

            </div>

            <div id="formstep2">
              <div class="col-main">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" class="proposicao-titulo-form" value="<?php echo $titulo; ?>">
                
                <textarea class="proposicao-conteudo" name="descricao" id="proposicao-conteudo" value="<?php echo $descricao; ?>"></textarea>


              </div>
              <div class="col-aside">
                <label for="duracao">Duração</label>
                <input type="text" id="duracao" name="duracao" value="<?php echo $duracao; ?>">
                <label for="materiais">Materiais Necessários</label>
                <input type="text" id="materiais" name="materiais" value="<?php echo $materiais; ?>">
              </div>
              <div class="clearthis"></div>
              <a href="#" id="next3" class="button-next">
                Próximo
              </a>

            </div>

            <div id="formstep3">
              <div class="col-category-publish">
                
                <h2>Categoria</h2>
                <input type="checkbox" class="checkbox-category-publish" id="sensibilidade" name="categoria[]"  value="<?php if ($sensibilidade!=null){value='check' }; ?>">
                <label class="checkbox" for="sensibilidade">Sensibilidade</label>
                <input type="checkbox" class="checkbox-category-publish" id="jogo" name="categoria[]"  value="jogo">
                <label class="checkbox" for="jogo">Jogo</label>
                <input type="checkbox" class="checkbox-category-publish" id="pratica_escrita" name="categoria[]"  value="pratica_escrita">
                <label class="checkbox" for="pratica_escrita">Prática Escrita</label>
              
                <h2>Por Habilidades Desenvolvidas</h2>

                <input type="checkbox" class="checkbox-category-publish" id="coesao-e-coerencia" name="categoria[]"  value="coesao_coerencia">
                <label class="checkbox" for="coesao-e-coerencia">Coesão e coerência</label>
                <input type="checkbox" class="checkbox-category-publish" id="tempos-verbais" name="categoria[]"  value="tempos_verbais">
                <label class="checkbox" for="tempos-verbais">Tempos verbais</label>
                <input type="checkbox" class="checkbox-category-publish" id="revisao-de-texto" name="categoria[]"  value="revisao_texto">
                <label class="checkbox" for="revisao-de-texto">Revisão do texto</label>
                <input type="checkbox" class="checkbox-category-publish" id="revisao-e-edicao" name="categoria[]"  value="revisao_edicao">
                <label class="checkbox" for="revisao-e-edicao">Revisão e edição</label>
                <input type="checkbox" class="checkbox-category-publish" id="vocabulario" name="categoria[]"  value="vocabulario">
                <label class="checkbox" for="vocabulario">Vocabulário</label>
              </div>
              <div class="col-category-publish">
                <h2>Por ambiente</h2>
                <input type="checkbox" class="checkbox-category-publish" id="espaco-aberto" name="categoria[]"  value="espaco_aberto">
                <label class="checkbox" for="espaco-aberto">Espaço aberto</label>
                <input type="checkbox" class="checkbox-category-publish" id="sala-de-aula" name="categoria[]"  value="sala_aula">
                <label class="checkbox" for="sala-de-aula">Sala de aula</label>
              </div>
              <div class="col-category-publish">
                <h2>Por recursos necessários</h2>
                <input type="checkbox" class="checkbox-category-publish" name="categoria[]" id="um-computador" name="categoria[]"  value="comp">
                <label class="checkbox" for="um-computador">Um computador</label>
                <input type="checkbox" class="checkbox-category-publish" id="um-computador-por-aluno" name="categoria[]" value="comp_aluno">
                <label class="checkbox" for="um-computador-por-aluno">Um computador por aluno</label>
                <input type="checkbox" class="checkbox-category-publish" id="papelaria"  name="categoria[]"  value="papelaria">
                <label class="checkbox" for="papelaria">Papelaria</label>
                <input type="checkbox" class="checkbox-category-publish" id="projetor" name="categoria[]"  value="projetor">
                <label class="checkbox" for="projetor">Projetor</label>
                <input type="checkbox" class="checkbox-category-publish" id="celulares-com-internet" name="categoria[]"  value="cel_internet">
                <label class="checkbox" for="celulares-com-internet">Celulares com internet</label>
              </div>
              <div class="col-category-publish">
                <h2>Por tamanho da turma</h2>
                <input type="checkbox" class="checkbox-category-publish" id="menos5" name="categoria[]"  value="cinco">
                <label class="checkbox" for="menos5">-5</label>
                <input type="checkbox" class="checkbox-category-publish" id="menos10" name="categoria[]"  value="dez">
                <label class="checkbox" for="menos10">-10</label>
                <input type="checkbox" class="checkbox-category-publish" id="menos15" name="categoria[]"  value="quinze">
                <label class="checkbox" for="menos15">-15</label>
                <input type="checkbox" class="checkbox-category-publish" id="menos20" name="categoria[]"  value="vinte">
                <label class="checkbox" for="menos20">-20</label>
                <input type="checkbox" class="checkbox-category-publish" id="menos30" name="categoria[]"  value="trinta">
                <label class="checkbox" for="menos30">-30</label>
                <input type="checkbox" class="checkbox-category-publish" id="mais30" name="categoria[]"  value="trinta_um">
                <label class="checkbox" for="mais30">+30</label>

              </div>
              <div class="clearthis"></div>
            <input type="submit"  class="btn btn-success" name="btn_save" value="Visualizar Publicação">
               
              

            </div>
          </form>
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
