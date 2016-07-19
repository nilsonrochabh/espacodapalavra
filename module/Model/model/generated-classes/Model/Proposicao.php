<?php

namespace Model;

use Model\Base\Proposicao as BaseProposicao;
use Model\Map\ProposicaoTableMap;
use Propel\Runtime\Propel;

/**
 * Skeleton subclass for representing a row from the 'proposicao' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Proposicao extends BaseProposicao
{
	
	const SENSIBILIZACAO = 'S';
	const JOGOS = 'J';
	const PRATICA_DE_ESCRITA = 'P';
	
	public static $CATEGORIA = array(
		'sensibilizacao' => self::SENSIBILIZACAO,
		'jogos' => self::JOGOS,
		'pratica-de-escrita' => self::PRATICA_DE_ESCRITA,
	);

	/**
     * Computes the value of the aggregate column tempo_total *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTempoTotal(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(duracao))) FROM passo WHERE passo.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }
	
	public function calcularTempoTotal() {
		$con = Propel::getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
		$this->setTempoTotal($this->computeTempoTotal($con));
	}
}
