<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Controller;

use Mocean\MoceanApiBroadcast\Mocean\Sms;
use Mocean\MoceanApiBroadcast\Domain\Repository\UserRepository;
use Mocean\MoceanApiBroadcast\Domain\Repository\UserGroupRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SmsController
 *
 * @package Mocean\MoceanApiBroadcast\Controller
 */
class SmsController extends ActionController
{
    //TODO: remove if unused
    /**
     * @var \Mocean\MoceanApiBroadcast\Domain\Repository\UserRepository
     */
    protected $userRepository;
    
    /**
     * @var \Mocean\MoceanApiBroadcast\Domain\Repository\UserGroupRepository
     */
    protected $userGroupRepository;
    
    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = BackendTemplateView::class;
       
    /**
     * SmsController constructor.
     *
     * @param UserRepository $userRepository
     * @param UserGroupRepository $userGroupRepository
     */
    public function __construct(UserRepository $userRepository, UserGroupRepository $userGroupRepository)
    {
        $this->userRepository = $userRepository;
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction(): void
    {
        $request = GeneralUtility::makeInstance(Sms::class);
        $request->setCredentials();
        $creditValue = $request->getCredit();
        
        if($creditValue['status'] == 0)
        {
            $currency = $request->getPricing();
            $creditBalance = $currency['destinations'][0]['currency'].' '.$creditValue['value'];
        }
        else
        {
            $creditBalance = $creditValue['err_msg'];
        }

        $this->view
                ->assign('creditBalance', $creditBalance);
    }
}
