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
     *
     * @var array
     */
    protected $options = array();

    /**
     *
     * @param string $wsdl
     * @param array $options
     * @throws \Exception
     */
    public function __construct($wsdl, $options = array())
    {
        if (! extension_loaded('soap')) {
            throw new \Exception("Soap Extention is required");
        }

        $this->options = array(
            'classmap' => array(
                'get_entry_list_result_version2' => GetEntryListResponse::class,               
                'entry_value' => EntryValue::class,
                'link_value2' => LinkValue::class,
                'entry_list'  => NameValueList::class,         
            ),
           
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 9,
            'trace' => false,
            'stream_context' =>  stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            ))
           
        );
        
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

        try {
            $result = $this->client->__call($function, $request->toArray());
            $properClass = new $returnType();
            
            if($properClass != null)
            {
                foreach($result as $n => $v)
                    $properClass->$n = $v;
            }
        } catch (\Exception $e) {
            if (is_soap_fault($result)) {
                throw new \Exception("fault");
            }
        }
        
        return $properClass;
    }
}