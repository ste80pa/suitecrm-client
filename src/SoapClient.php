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
     * @var \SoapClient
     */
    protected $client;

    /**
     *
     * @var boolean
     */
    protected $nonWsdlMode = true;

    /**
     *
     * @var array
     */
    protected $options = array(
        'classmap' => array(
            'get_entry_list_result_version2' => GetEntryListResponse::class,
            'entry_value' => EntryValue::class,
            'link_value2' => LinkValue::class
            // 'entry_list' => NameValueList::class,
        ),
        
        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 9,
        'exceptions' => 1,
        'trace' => 0
    );

    /**
     *
     * @param Session $session
     * @param boolean $nonWsdlMode
     *            if true works in non wsdl mode. Preferred due a bug in PhpSoap that cause memeory exausting exception.
     *            For details see <a href="https://bugs.php.net/bug.php?id=70900">https://bugs.php.net/bug.php?id=70900</a>
     * @param array $options
     *            For detailed options see <a href="http://php.net/manual/en/soapclient.soapclient.php">http://php.net/manual/en/soapclient.soapclient.php</a>
     * @throws \Exception
     */
    public function __construct(Session $session, $nonWsdlMode = true, $options = array())
    {
        parent::__construct($session);
        
        if (! extension_loaded('soap')) {
            throw new \Exception("Soap Extention is required");
        }
        
        $wsdl    = null;
        $url     = $session->getUrl();
        $version = $session->getEndpointVersion();
        
        $this->nonWsdlMode = $nonWsdlMode;
        
        if ($nonWsdlMode) {
            $this->options['location'] = "{$url}/service/{$version}/soap.php";
            $this->options['uri'] = "{$url}/service/{$version}/";
        } else {
            $wdsl = "{$url}/service/{$version}/soap.php?wsdl";
        }
        
        $this->options['stream_context'] = stream_context_create(array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        ));
        
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
    public function invoke($function, BaseRequest $request, $returnType = null)
    { 
       if( property_exists($request, 'session'))
            $request->session = $this->session->getId();
        
        $result = null;
        $properClass = null;
        
        $result = $this->client->__call($function, $request->toArray());
       
        if ($this->nonWsdlMode) {
            $properClass = new $returnType($result);
        } else {
            $properClass = new $returnType();
            
            foreach ($result as $n => $v)
                $properClass->$n = $v;
        }
        return $properClass;
    }
}