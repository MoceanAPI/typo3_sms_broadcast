<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Class HistoryRepository
 *
 * @package Mocean\MoceanApiBroadcast\Domain\Repository
 */
class HistoryRepository extends Repository
{
    protected $defaultOrderings = array(
        'uid' => QueryInterface::ORDER_DESCENDING
    );
    
	public function initializeObject() {
		$querySettings = new Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
    
    //Search by user input of search value for all fields
    public function findByValue($val)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr([
                $query->like('sender', '%'.$val.'%'),
                $query->lessThanOrEqual('datetime', strtotime($val)),
                $query->like('message', '%'.$val.'%'),
                $query->like('recipient', '%'.$val.'%'),
                $query->like('response', '%'.$val.'%'),
                $query->like('status', '%'.$val.'%')
            ]));
        return $query->execute();
    }
}
