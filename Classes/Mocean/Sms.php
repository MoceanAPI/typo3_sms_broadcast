<?php
declare(strict_types = 1);
namespace Mocean\MoceanApiBroadcast\Mocean;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

class Sms 
{
    /**
     * The API key of Mocean account
     *
     * @var string
     **/
    protected $apiKey;
    
    /**
     * The API secret of Mocean account
     *
     * @var string
     **/
    protected $apiSecret;
    
    /**
     * The sender of the sms
     *
     * @var string
     **/
    protected $sender;
    
    /**
     * The recipient of the sms
     *
     * @var string
     **/
    protected $recipient;
    
    /**
     * The message of the sms
     *
     * @var string
     **/
    protected $message;
    
    /**
     * The country code of the sms
     *
     * @var string
     **/
    protected $countryCode;
    
    /**
     * Sets Mocean account credentials
     *
     * @param string $apiKey
     * @param string $apiSecret
     */
    function setCredentials() 
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('mocean_api_broadcast');
        $this->apiKey = $extensionConfiguration['moceanApiKey'];
        $this->apiSecret = $extensionConfiguration['moceanApiSecret'];
    }
    
    /**
     * Sets the sender of the sms
     *
     * @param string $sender
     */
    function setSender($sender) 
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
     * Sets the recipient of the sms
     *
     * @param string $recipient
     */
    function setRecipient($recipient) 
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
     * Sets the message of the sms
     *
     * @param string $message
     */
    function setMessage($message) 
    {
        $this->message = $message;
    }
    
    /**
     * Gets the message of the sms
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Sets the country code of the sms
     *
     * @param string $countryCode
     */
    function setCountryCode($countryCode) 
    {
        $this->countryCode = $countryCode;
    }
    
   /**
    * SMS API.
    */
    function sendBroadcast() 
    {
        $url = 'https://rest.moceanapi.com/rest/2/sms?';
        $fields = array(
            'mocean-api-key' => $this->apiKey,
            'mocean-api-secret' => $this->apiSecret,
            'mocean-from' => $this->sender,
            'mocean-to' => $this->recipient,
            'mocean-text' => $this->message,
            'mocean-resp-format' => 'json',
            'mocean-medium'=>'typo3_broadcast'
        );

        $fields_string = '';
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);
        
        $log = 'request: {'.$url.$fields_string.'}, response: {'.$result.'}';

        $json = json_decode($result, true);
        $json['log'] = $log;

        //returns an array
        return $json;
    }
    
   /**
    * Query API check credits.
    */
    public function getCredit() 
    {
        $url = 'https://rest.moceanapi.com/rest/1/account/balance?';
        $fields = array(
            'mocean-api-key'=>$this->apiKey,
            'mocean-api-secret'=>$this->apiSecret,
            'mocean-resp-format'=>'json'
        );

        $fields_string = '';
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        $fields_string = rtrim($fields_string, '&');

        $url_final = $url.$fields_string;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url_final);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);
        
        $json = json_decode($result, true);
   
        //returns an array
        return $json;
    }
  
   /**
    * Query API check pricing and currency.
    */
    public function getPricing() 
    {
        $url = 'https://rest.moceanapi.com/rest/2/account/pricing?';
        $fields = array(
            'mocean-api-key'=>$this->apiKey,
            'mocean-api-secret'=>$this->apiSecret,
            'mocean-resp-format'=>'json',
            'mocean-type'=>'verify'
        );

        $fields_string = '';
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        $fields_string = rtrim($fields_string, '&');

        $url_final = $url.$fields_string;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url_final);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
        $result = curl_exec($ch);

        curl_close($ch);

        $json = json_decode($result, true);
    
        //returns an array
        return $json;
    }
    
   /**
    * Dev API check country code.
    */
    public function checkCountryCode() 
    {
        $url = 'https://dev.moceansms.com/public/mobileChecking?';
        $fields = array(
            'mobile_number'=>$this->recipient,
            'country_code'=>$this->countryCode
        );

        $fields_string = '';
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        $url_final = $url.$fields_string;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url_final);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);
   
        //returns phone number
        return $result;
    }
}
?>
