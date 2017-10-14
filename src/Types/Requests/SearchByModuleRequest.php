<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class SearchByModuleRequest extends BaseRequest
{

    /**
     * Session ID returned by a previous login call.
     * 
     * @var string
     */
    public $session;

    /**
     *
     * @var string
     */
    public $search_string;

    /**
     *
     * @var mixed
     */
    public $modules;

    /**
     *
     * @var integer
     */
    public $offset;

    /**
     *
     * @var integer
     */
    public $max_results;

    /**
     *
     * @var string
     */
    public $assigned_user_id;

    /**
     *
     * @var mixed
     */
    public $select_fields;

    /**
     *
     * @var boolean
     */
    public $unified_search_only;

    /**
     *
     * @var boolean
     */
    public $favorites;
}
