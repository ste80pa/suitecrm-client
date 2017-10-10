<?php
namespace ste80pa\SuiteCRMClient;

use ste80pa\SuiteCRMClient\Types\EntryValue;
use ste80pa\SuiteCRMClient\Types\BaseRequest;
use ste80pa\SuiteCRMClient\Types\LinkValue;
use ste80pa\SuiteCRMClient\Types\Responses\GetEntryListResponse;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class SoapClient extends Client
{

    /**
     *
     * @var
     */
    protected $client;

    /**
     * @var boolean
     */
    protected $nonWsdlMode = true;
    /**
     *
     * @var array
     */
    protected $options = array
    (
        'classmap' => array
        (
            'get_entry_list_result_version2' => GetEntryListResponse::class,               
            'entry_value' => EntryValue::class,
            'link_value2' => LinkValue::class,
            'entry_list'  => NameValueList::class,         
        ),
       
        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 9,
    );

    /**
     *
     * @param string $url url for suite crm in example http://suitecrm.doamin.local
     * @param string $verion version
     * @param boolean $nonWsdlMode if true works in non wsdl mode. Preferred due a bug in PhpSoap that cause memeory exausting exception @see https://bugs.php.net/bug.php?id=70900
     * @param array $options options @see http://php.net/manual/en/soapclient.soapclient.php
     * @throws \Exception
     */
    public function __construct($url, $version = 'v4_1', $nonWsdlMode = true, $options = array())
    {
        if (! extension_loaded('soap')) {
            throw new \Exception("Soap Extention is required");
        }

        $this->nonWsdlMode = $nonWsdlMode;

        $wsdl = null;

        if($nonWsdlMode)
        {
            $this->options['location'] = "{$url}/service/{$version}/soap.php";
            $this->options['uri']      = "{$url}/service/{$version}/";
        }
        else
        {
            $wdsl = "{$url}/service/{$version}/soap.php?wsdl";
        }
    
        $this->options['stream_context'] = stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            )
        );  
        
        $this->options = array_merge($this->options, $options);

        $this->client = new \SoapClient($wsdl, $this->options);
    }

    /**
     * Parameter types (and order) must be the same as what the current wsdl defines.
     * 
     * @param string $function
     * @param BaseRequest $request
     * @param string $returnType
     * @throws \Exception
     */
    public function Invoke($function, BaseRequest $request, $returnType = null)
    {        
        if(isset($this->session) && !empty($this->session))
        {
            if ($request->session == null)
                $request->session = $this->session->id;
        }
        
        $result = null;
        $properClass = null;

        $result = $this->client->__call($function, $request->toArray());
            
        if($this->nonWsdlMode)
        {
            $properClass = new $returnType($result);
        }
        else
        {
            $properClass = new $returnType();
            
            foreach($result as $n => $v)
                $properClass->$n = $v;
            
        }
        return $properClass;
    }
}