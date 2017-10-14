<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class SeamlessLoginRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    
    /**
     * 
     * @param string $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }
   
}
