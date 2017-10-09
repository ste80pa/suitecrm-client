<?php
namespace ste80pa\SuiteCRMClient;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class RestClient extends Client
{

    /**
     * 
     * @throws \Exception
     */
    public function __construct()
    {
        if (! extension_loaded('curl')) {
            throw new \Exception("Curl Extention is required");
        }
    }

    /**
     * Parameter types (and order) must be the same as what the current wsdl defines.
     *
     * @param string $function
     * @param BaseRequest $request
     * @param string $returnType
     * @throws \Exception
     */
    public function Invoke($function, BaseRequest $request)
    {
        
    }
}