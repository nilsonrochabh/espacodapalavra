<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Core\Exception\CoreException;
use Model\AmbienteProposicao;
use Model\AmbienteProposicaoQuery;
use Model\Comentario;
use Model\Concluir;
use Model\ConcluirQuery;
use Model\Curtir;
use Model\CurtirQuery;
use Model\HabilidadeProposicao;
use Model\HabilidadeProposicaoQuery;
use Model\Map\ProposicaoTableMap;
use Model\Proposicao;
use Model\ProposicaoQuery;
use Model\Passo;
use Model\PassoQuery;
use Model\RecursoProposicao;
use Model\RecursoProposicaoQuery;
use Model\Seguir;
use Model\SeguirQuery;
use Model\TamanhoTurmaProposicao;
use Model\TamanhoTurmaProposicaoQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Util\Util;

/**
 * Classe Core\BO$ProposicaoBO
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 17/07/2016 14:38:07
 */
class ProposicaoBO extends BO {

	/**
	 * Método getByPK
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return \Model\Proposicao
	 */
	public function getByPK($id) {
		return ProposicaoQuery::create()->findPk($id);
	}
	
	/**
	 * Método getByIds
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param multitype:int $ids
	 * @return multitype:\Model\Proposicao
	 */
	public function getByIds($ids) {
		return ProposicaoQuery::create()
			->filterById($ids, Criteria::IN)
			->find();
	}
	
	/**
	 * Método save
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Proposicao $o
	 * @throws Exception
	 * @return boolean
	 */
	public function save(Proposicao $o, $imagem = null) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		// Resize Image
		if($imagem != null) {
			try {
				$thumbnailer = $this->getServiceLocator()->get('WebinoImageThumb');
				$thumb = $thumbnailer->create($imagem, $options = [], $plugins = []);
				$thumb->adaptiveResize(1146, 302);
				$thumb->save($imagem);
				
				$thumb = $thumbnailer->create($imagem, $options = [], $plugins = []);
				$thumb->adaptiveResize(363, 302);
				$thumb->save('./public/uploads/thumb_' . basename($imagem));
				
				$o->setImagem(basename($imagem));
			} catch (\Exception $e) {
				$this->handleException($e);
			}
		}
		
		try {
			$o->save($con);
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método salvarCategorizacao
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Proposicao $o
	 * @throws Exception
	 * @return boolean
	 */
	public function salvarCategorizacao(Proposicao $o, $categoria, $habilidade, $ambiente, $recurso, $tamanho) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$o->setCategoria($categoria);
			
			HabilidadeProposicaoQuery::create()->filterByProposicao($o)->delete($con);
			foreach($habilidade as $g) {
				$hp = new HabilidadeProposicao();
				$hp->setIdHabilidade($g);
				
				$o->addHabilidadeProposicao($hp);
			}
			
			AmbienteProposicaoQuery::create()->filterByProposicao($o)->delete($con);
			foreach($ambiente as $g) {
				$hp = new AmbienteProposicao();
				$hp->setIdAmbiente($g);
				
				$o->addAmbienteProposicao($hp);
			}
			
			RecursoProposicaoQuery::create()->filterByProposicao($o)->delete($con);
			foreach($recurso as $g) {
				$hp = new RecursoProposicao();
				$hp->setIdRecurso($g);
				
				$o->addRecursoProposicao($hp);
			}
			
			TamanhoTurmaProposicaoQuery::create()->filterByProposicao($o)->delete($con);
			foreach($tamanho as $g) {
				$hp = new TamanhoTurmaProposicao();
				$hp->setIdTamanhoTurma($g);
				
				$o->addTamanhoTurmaProposicao($hp);
			}
			
			$o->save($con);
			$con->commit();
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		$this->validaProposicao($o);
		
		$con->beginTransaction();
		try {
			$o->setIsRascunho(0);
			$o->save($con);
			$con->commit();
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
	}
	
	/**
	 * Método delete
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 18/07/2016 21:14:55
	 * @param Proposicao $proposicao
	 */
	public function validaProposicao(Proposicao $proposicao) {
		if(Util::IsNullOrEmptyString($proposicao->getNome()) ||
			  Util::IsNullOrEmptyString($proposicao->getObjetivo()) ||
			  Util::IsNullOrEmptyString($proposicao->getStart())) {
			throw new CoreException($this->_('Verifique os campos da aba Passo 01 - Informações'));
		}
		
		if($proposicao->countPassos() == 0) {
			throw new CoreException($this->_('Cadastre pelo menos um passo na aba Passo 02 - Montagem'));
		}
	}
	
	/**
	 * Método delete
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return int
	 */
	public function delete($id) {
		return ProposicaoQuery::create()->filterById($id)->delete();
	}
	
	/**
	 * Método getPasso
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return \Model\Passo
	 */
	public function getPasso($id, $idProposicao) {
		return PassoQuery::create()->filterById($id)->filterByIdProposicao($idProposicao)->findOne();
	}
	
	/**
	 * Método savePasso
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Passo $o
	 * @param Proposicao $p
	 * @throws Exception
	 * @return boolean
	 */
	public function savePasso(Passo $o, Proposicao $p) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$p->addPasso($o);
			$p->save($con);
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método deletePasso
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Passo $o
	 * @param Proposicao $p
	 * @throws Exception
	 * @return boolean
	 */
	public function deletePasso($idPasso, $idProposicao) {
		$passo = $this->getPasso($idPasso, $idProposicao);
		if($passo == null) {
			throw new CoreException($this->_('Proposição não encontrada.'));
		}
		
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$passo->delete($con);
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método deletePasso
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Passo $o
	 * @param Proposicao $p
	 * @throws Exception
	 * @return boolean
	 */
	public function lista($categoria = null, $busca = null) {
		$query = ProposicaoQuery::create()
			->filterByIsRascunho(0);
		
		if($categoria) {
			$query->filterByCategoria($categoria);
		}
		
		if(!Util::IsNullOrEmptyString($busca)) {
			$keywords = explode(' ', $busca);
			
			foreach($keywords as $key) {
				$query->_and();
				$query->filterByNome('%' . $key . '%', Criteria::LIKE);
				$query->_or();
				$query->filterByObjetivo('%' . $key . '%', Criteria::LIKE);
				$query->_or();
				$query->filterByStart('%' . $key . '%', Criteria::LIKE);
			}
		}
		
		$query->orderByNome();
		
		return $query->find();
	}
	
	/**
	 * Método deletePasso
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @throws Exception
	 */
	public function minhaLista($idUsuarioLogado) {
		return ProposicaoQuery::create()
			->filterByIdUsuario($idUsuarioLogado)
			->orderByNome()
			->find();
	}
	
	/**
	 * Método adicionarComentario
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @throws Exception
	 */
	public function adicionarComentario(Proposicao $proposicao, $idUsuarioLogado, $textoComentario) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$comentario = new Comentario();
			$comentario->setIdUsuario($idUsuarioLogado);
			$comentario->setDataCadastro(Util::agora());
			$comentario->setComentario($textoComentario);
			$comentario->setIdProposicao($proposicao->getId());
			$comentario->save();
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método seguir
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @throws Exception
	 */
	public function seguir(Proposicao $proposicao, $idUsuarioLogado) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$jaSegue = SeguirQuery::create()
				->filterByIdUsuario($idUsuarioLogado)
				->filterByProposicao($proposicao)
				->count();
			
			if($jaSegue > 0) {
				SeguirQuery::create()
					->filterByIdUsuario($idUsuarioLogado)
					->filterByProposicao($proposicao)
					->delete($con);
			} else {
				$seguir = new Seguir();
				$seguir->setIdUsuario($idUsuarioLogado);
				$seguir->setIdProposicao($proposicao->getId());
				$seguir->setDataCadastro(Util::agora());
				$seguir->save($con);
			}
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método curtir
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @throws Exception
	 */
	public function curtir(Proposicao $proposicao, $idUsuarioLogado) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$jaSegue = CurtirQuery::create()
				->filterByIdUsuario($idUsuarioLogado)
				->filterByProposicao($proposicao)
				->count();
			
			if($jaSegue > 0) {
				CurtirQuery::create()
					->filterByIdUsuario($idUsuarioLogado)
					->filterByProposicao($proposicao)
					->delete($con);
			} else {
				$curtir = new Curtir();
				$curtir->setIdUsuario($idUsuarioLogado);
				$curtir->setIdProposicao($proposicao->getId());
				$curtir->setDataCadastro(Util::agora());
				$curtir->save($con);
			}
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
	
	/**
	 * Método concluir
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @throws Exception
	 */
	public function concluir(Proposicao $proposicao, $idUsuarioLogado) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$jaSegue = ConcluirQuery::create()
				->filterByIdUsuario($idUsuarioLogado)
				->filterByProposicao($proposicao)
				->count();
			
			if($jaSegue > 0) {
				ConcluirQuery::create()
					->filterByIdUsuario($idUsuarioLogado)
					->filterByProposicao($proposicao)
					->delete($con);
			} else {
				$concluir = new Concluir();
				$concluir->setIdUsuario($idUsuarioLogado);
				$concluir->setIdProposicao($proposicao->getId());
				$concluir->setDataCadastro(Util::agora());
				$concluir->save($con);
			}
			
			$con->commit();
			return true;
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return false;
	}
}
