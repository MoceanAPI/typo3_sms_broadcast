<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Factory;

use Mocean\MoceanApiBroadcast\Domain\Repository\UserRepository;
use Mocean\MoceanApiBroadcast\Domain\Repository\UserGroupRepository;
use Mocean\MoceanApiBroadcast\Domain\Finishers\SmsFormFinisher;
use Mocean\MoceanApiBroadcast\Domain\Validation\ValidateRecipient;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Validation\Validator\NotEmptyValidator;
use TYPO3\CMS\Form\Domain\Configuration\ConfigurationService;
use TYPO3\CMS\Form\Domain\Factory\AbstractFormFactory;
use TYPO3\CMS\Form\Domain\Model\FormDefinition;

class SmsFormFactory extends AbstractFormFactory
{
    /**
     * @var \Mocean\MoceanApiBroadcast\Domain\Repository\UserRepository
     */
    protected $userRepository;
    
    /**
     * @var \Mocean\MoceanApiBroadcast\Domain\Repository\UserGroupRepository
     */
    protected $userGroupRepository;
    
    /**
     * SmsFormFactory constructor.
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
     * @return FormDefinition
     */
    public function build(array $configuration, string $prototypeName = null): FormDefinition
    {
        $prototypeName = 'standard';
        $configurationService = GeneralUtility::makeInstance(ObjectManager::class)->get(ConfigurationService::class);
        $prototypeConfiguration = $configurationService->getPrototypeConfiguration($prototypeName);

        $form = GeneralUtility::makeInstance(ObjectManager::class)->get(FormDefinition::class, 'SmsForm', $prototypeConfiguration);
        $form->setRenderingOption('controllerAction', 'index');

        $page1 = $form->createPage('page1');      
        
        //Select recipient
        $recipient = $page1->createElement('recipient', 'SingleSelect');
        $recipient->setProperty('options', ['0' => '-- Select Recipient --', '1' => 'All Users', '2' => 'Specific Users', '3' => 'Specific User Group', '4' => 'Specific Phone Numbers']);
        $recipient->setProperty('fluidAdditionalAttributes', ['onchange' => 'showBySelect()']); 
        $recipient->setLabel('Recipient');
        $recipient->addValidator(GeneralUtility::makeInstance(ObjectManager::class)->get(NotEmptyValidator::class));
        $recipient->addValidator(GeneralUtility::makeInstance(ValidateRecipient::class));
        
        //Populate options for send to usergroup selection
        $groups = $this->userGroupRepository->findAll();
        $groupsSelection = array();
        $groupsSelection[0] = '-- Select Group --';
        foreach($groups as $group)
        {
            $groupsSelection[$group->getUid()] = $group->getTitle();
        }
        $specificGroup = $page1->createElement('specificGroup', 'SingleSelect');
        $specificGroup->setProperty('options', $groupsSelection);
        $specificGroup->setProperty('fluidAdditionalAttributes', ['style' => 'display: none;']);  
        
        //Textarea field for specific phone numbers
        $specificPhone = $page1->createElement('specificPhone', 'Textarea');
        $specificPhone->setProperty('fluidAdditionalAttributes', ['style' => 'display: none;', 'placeholder' => 'Use space as delimiter, country code is required (e.g. 60123456789 60123456666)']); 
        
        //Populate options for send to user selection
        $users = $this->userRepository->findAll();
        $userSelection = array();
        foreach($users as $user)
        {
            if($user->getTelephone())
                $userSelection[$user->getUid()] = $user->getUsername();
        }
        $specificUsers = $page1->createElement('specificUsers', 'MultiSelect');
        $specificUsers->setProperty('options', $userSelection);
        $specificUsers->setProperty('fluidAdditionalAttributes', ['style' => 'display: none;']); 
        
        //Textarea for message of SMS
        $message = $page1->createElement('message', 'Textarea');
        $message->setProperty('fluidAdditionalAttributes', ['style' => 'height: 150px;']);
        $message->setLabel('Message');
        $message->addValidator(GeneralUtility::makeInstance(ObjectManager::class)->get(NotEmptyValidator::class));

        $form->addFinisher(GeneralUtility::makeInstance(SmsFormFinisher::class));

        $this->triggerFormBuildingFinished($form);
        return $form;
    }
}