<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

class History extends AbstractEntity
{
	/**
     * The sender of the sms
     *
     * @var string
     **/
    protected $sender = '';

    /**
     * The date and time when sms sent
     *
     * @var int
     **/
    protected $datetime = '';

    /**
     * The recipient of the sms
     *
     * @var string
     **/
    protected $recipient = '';

    /**
     * The message sent
     *
     * @var string
     **/
    protected $message = '';

    /**
     * The response of the sms request
     *
     * @var string
     **/
    protected $response = '';

    /**
     * The status of the sms request
     *
     * @var string
     **/
    protected $status = '';

    /**
     * The sms log
     *
     * @var string
     **/
    protected $smsLog = '';

    /**
     * History constructor.
     */
    public function __construct()
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('mocean_api_broadcast');
        $sender = $this->countryCode = $extensionConfiguration['moceanMessageFrom'];
        $this->setSender($sender);
    }

    /**
     * Sets the sender of the sms
     *
     * @param string $sender
     */
    public function setSender(string $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Gets the sender of the sms
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets the date and time when sms sent
     *
     * @param int $datetime
     */
    public function setDatetime(int $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * Gets the date and time when sms sent
     *
     * @return datetime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Sets the recipient of the sms
     *
     * @param string $recipient
     */
    public function setRecipient(string $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Gets the recipient of the sms
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Sets the message sent
     *
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Gets the message sent
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the response of the sms request
     *
     * @param string $response
     */
    public function setResponse(string $response)
    {
        $this->response = $response;
    }

    /**
     * Gets the response of the sms request
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the status of the sms request
     *
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Gets the status of the sms request
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the sms log
     *
     * @param string $status
     */
    public function setSmsLog(string $smsLog)
    {
        $this->smsLog = $smsLog;
    }

    /**
     * Gets the sms log
     *
     * @return string
     */
    public function getSmsLog()
    {
        return $this->smsLog;
    }
}
