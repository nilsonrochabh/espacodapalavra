<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Core\Exception\CoreException;
use Model\AmbienteProposicao;
use Model\AmbienteProposicaoQuery;
use Model\HabilidadeProposicao;
use Model\HabilidadeProposicaoQuery;
use Model\Map\ProposicaoTableMap;
use Model\Proposicao;
use Model\ProposicaoQuery;
use Model\Passo;
use Model\PassoQuery;
use Model\RecursoProposicao;
use Model\RecursoProposicaoQuery;
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
	public function save(Proposicao $o) {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
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
}
