<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetAvailableModulesRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var string
     */
    public $filter;
}
