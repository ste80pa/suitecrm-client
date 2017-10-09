<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetModuleFieldsMd5Request extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var mixed
     */
    public $module_names;
}
