<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Model\Map\UsuarioTableMap;
use Model\Usuario;
use Model\UsuarioQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Util\Util;

/**
 * Classe Core\BO$UsuarioBO
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 24/05/2016 21:14:55
 */
class UsuarioBO extends BO {

	/**
	 * Método getByPK
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return \Model\Usuario
	 */
	public function getByPK($id) {
		return UsuarioQuery::create()->findPk($id);
	}
	
	/**
	 * Método getByIds
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param multitype:int $ids
	 * @return multitype:\Model\Usuario
	 */
	public function getByIds($ids) {
		return UsuarioQuery::create()
			->filterById($ids, Criteria::IN)
			->find();
	}
	
	/**
	 * Método checkEmailExiste
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 14/04/2016 15:31:05
	 * @param string $email
	 * @param int $idExclude
	 */
	public function checkEmailExiste($email, $idExclude = 0) {
		$query = UsuarioQuery::create()->filterByEmail($email);
		
		if($idExclude > 0) {
			$query->filterById($idExclude, Criteria::NOT_EQUAL);
		}
		
		$cont = $query->count();
		
		if($cont > 0) {
			throw new EmailExistenteException($this->_('Email já existe.'));
		}
	}
	
	/**
	 * Método registrar
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 17/07/2016 10:18:13
	 * @param string $nome
	 * @param string $email
	 * @param string $atuacao
	 * @param string $genero
	 * @param string $senha
	 * @param string $sobre
	 * @throws Exception
	 * @return boolean
	 */
	public function registrar($nome, $email, $atuacao, $genero, $senha, $sobre, $foto) {
		$config = $this->getServiceLocator()->get('Config');
		$salt = $config['security']['salt'];
		
		$email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
		$senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
		if($senha) {
			$senha = Util::crypt($senha, $salt);
		}
		
		$this->checkEmailExiste($email);
		
		// Resize Image
		try {
			$thumbnailer = $this->getServiceLocator()->get('WebinoImageThumb');
			$thumb = $thumbnailer->create($foto, $options = [], $plugins = []);
			$thumb->resize(160, 160);
			$thumb->save($foto);
		} catch (\Exception $e) {
			$this->handleException($e);
		}
		
		$con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			$usuario = new Usuario();
			$usuario->setNome($nome);
			$usuario->setEmail($email);
			$usuario->setSenha($senha);
			$usuario->setDataCadastro(Util::agora());
			$usuario->setIsAdmin(0);
			$usuario->setAtuacao($atuacao);
			$usuario->setGenero($genero);
			$usuario->setDescricaoContexto($sobre);
			$usuario->setImagemProfile(basename($foto));
			
			$usuario->save($con);
			
			$con->commit();
		} catch (\Exception $e) {
			$con->rollback();
			throw $e;
		}
		
		return $usuario;
	}
	
	/**
	 * Método save
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param Usuario $o
	 * @throws Exception
	 * @return boolean
	 */
	public function save(Usuario $o) {
		$con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
		$con->beginTransaction();
		
		try {
			
			if($o->isNew()) {
				$config = $this->getServiceLocator()->get('Config');
				$salt = $config['security']['salt'];
				$o->setPassword(Util::crypt($o->getPassword(), $salt));
			}
			
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
	 * Método delete
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return int
	 */
	public function delete($id) {
		return UsuarioQuery::create()->filterById($id)->delete();
	}
}
