<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Controller;

use Mocean\MoceanApiBroadcast\Domain\Repository\HistoryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Backend\View\BackendTemplateView;

/**
 * Class HistoryController
 *
 * @package Mocean\MoceanApiBroadcast\Controller
 */
class HistoryController extends ActionController
{

    /**
     * @var \Mocean\MoceanApiBroadcast\Domain\Repository\HistoryRepository
     */
    protected $historyRepository;
    
    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = BackendTemplateView::class;
    
    /**
     * HistoryController constructor.
     *
     * @param HistoryRepository $historyRepository
     */
    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction(): void
    {
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->historyRepository);
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->historyRepository->findAll());
        $history = $this->historyRepository->findAll();
        $this->view
            ->assign('history', $history);
    }
    
    /**
     * Search Action
     *
     * @param string $searchValue
     * @return void
     */
    public function searchAction($searchValue): void
    {
        if($searchValue)
            $history = $this->historyRepository->findByValue($searchValue);
        else
            $history = $this->historyRepository->findAll();
        $this->view
            ->assign('history', $history);
    }
    
    /**
     * Export Action
     *
     * @return application/json
     */
    public function exportAction()
    {
        $data = array();
        $history = $this->historyRepository->findAll();
        
        foreach($history as $h)
        {
            $data[] = $h->getSmsLog();
        }

        header('Content-type:application/json;charset=utf-8');
        header('Content-Disposition: attachment; filename="TYPO3_MoceanApiBroadcastLog.json"');

        return json_encode($data);
    }
}
