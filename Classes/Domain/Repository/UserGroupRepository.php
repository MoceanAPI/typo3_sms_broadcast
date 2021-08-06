<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Class UserGroupRepository
 *
 * @package Mocean\MoceanApiBroadcast\Domain\Repository
 */
class UserGroupRepository extends Repository
{
    protected $defaultOrderings = array(
        'uid' => QueryInterface::ORDER_ASCENDING
    );
    
	public function initializeObject() {
		$querySettings = new Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
}
