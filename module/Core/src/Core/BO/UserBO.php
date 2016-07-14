<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Model\Map\UserTableMap;
use Model\User;
use Model\UserQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Util\Util;

/**
 * Classe Core\BO$UserBO
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 24/05/2016 21:14:55
 */
class UserBO extends BO {

	/**
	 * Método getByPK
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param int $id
	 * @return \Model\User
	 */
	public function getByPK($id) {
		return UserQuery::create()->findPk($id);
	}
	
	/**
	 * Método getByIds
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param multitype:int $ids
	 * @return multitype:\Model\User
	 */
	public function getByIds($ids) {
		return UserQuery::create()
			->filterByIdUser($ids, Criteria::IN)
			->find();
	}
	
	/**
	 * Método save
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param User $o
	 * @throws Exception
	 * @return boolean
	 */
	public function save(User $o) {
		$con = Propel::getWriteConnection(UserTableMap::DATABASE_NAME);
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
		return UserQuery::create()->filterById($id)->delete();
	}
	
	/**
	 * Método listUsers
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 24/05/2016 21:14:55
	 * @param string $nome
	 * @param int $start
	 * @param int $linhas
	 * @param string $orderBy
	 * @param string $orderType
	 * @return \Core\Model\DTO
	 */
	public function listUsers($email, $start, $linhas, $orderBy = null, $orderType = null) {
		$query = UserQuery::create();
		
		if(!Util::IsNullOrEmptyString($email)) {
			$query->filterByPaypalEmail('%' . $email . '%');
		}
		
		$orderType = $orderType == 'desc' ? Criteria::DESC : Criteria::ASC;
		
		if($orderBy == 0) {
			$query->orderByIdUser($orderType);
		} elseif($orderBy == 1) {
			$query->orderByPaypalEmail($orderType);
		}
		
		return $this->createDTO($query, $start, $linhas);
	}
}
