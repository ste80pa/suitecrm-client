<?php
namespace ste80pa\SuiteCRMClient;

use Exception;
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
     * @var string
     */
    protected $endopoint = null;

    /**
     *
     * @throws \Exception
     */
    public function __construct(Session $session)
    {   
        parent::__construct($session);
        
        if (! extension_loaded('curl')) {
            throw new Exception("Curl Extention is required");
        }
        
        $this->endopoint = "{$session->getUrl()}/service/{$session->getEndpointVersion()}/rest.php";
    }

    /**
     *
     * @param string $function
     * @param BaseRequest $request
     * @param string $returnType
     * @throws \Exception
     */
    public function invoke($function, BaseRequest $request, $returnType = null)
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->endopoint);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
       
        if(isset($request->session))
            $request->session = $this->session->getId();
        
        
        $json = json_encode($request);
        
        $post = array(
            'method' => $function,
            'input_type' => 'JSON',
            'response_type' => 'JSON',
            'rest_data' => $json
        );
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        $result = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        $result = explode("\r\n\r\n", $result, 2);
        
        switch ($http_status) {
            case 0:
                throw new Exception("Host not found");
                break;
            
            case 200:
                
                if ($returnType == null)
                    return json_decode($result[1]);
                else
                    return new $returnType(json_decode($result[1]));
                break;
            default:
                throw new Exception("Received " + $http_status);
        }
        return null;
    }
}