<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class LoginRequest extends BaseRequest {
    /**
     * @var mixed
     */
    public $user_auth = array();
    /**
     * @var string
     */
    public $application_name = 'SuiteCRMClient';
    /**
     * @var mixed
     */
    public $name_value_list = array();
    
    /**
     * 
     * @param string $username
     * @param string $password
     * @param string $version
     */
    public function __construct($username, $password, $version = '1'){
        $this->user_auth = array
        (
                'user_name' => $username,
                'password'  => md5($password),
                'version'   => $version
        );
    }
}
