<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Class UserRepository
 *
 * @package Mocean\MoceanApiBroadcast\Domain\Repository
 */
class UserRepository extends Repository
{
    protected $defaultOrderings = array(
        'uid' => QueryInterface::ORDER_ASCENDING
    );
    
	public function initializeObject() {
		$querySettings = new Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
    
    //Return all users in selected usergroup
    public function findByUserGroup($userGroupUid)
    {
        $query = $this->createQuery();
        $query->matching($query->equals('usergroup', $userGroupUid));
        return $query->execute();
    }
}
