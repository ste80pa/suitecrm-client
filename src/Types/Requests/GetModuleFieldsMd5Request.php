<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class GetModuleFieldsMd5Request extends BaseRequest
{

    /**
     * Session ID returned by a previous login call.
     *
     * @var string
     */
    public $session;

    /**
     * The list of modules to retrieve last viewed records for.
     * 
     * @var mixed
     */
    public $module_names;
}
