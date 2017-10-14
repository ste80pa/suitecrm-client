<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class SetRelationshipRequest extends BaseRequest
{

    /**
     * Session ID returned by a previous login call.
     *
     * @var string
     */
    public $session;

    /**
     * The name of the module from which to retrieve records.
     * Note: This is the modules key which may not be the same as the modules display name.
     *
     * @var string
     */
    public $module_name;

    /**
     *
     * @var string
     */
    public $module_id;

    /**
     *
     * @var string
     */
    public $link_field_name;

    /**
     *
     * @var mixed
     */
    public $related_ids;

    /**
     *
     * @var mixed
     */
    public $name_value_list;

    /**
     *
     * @var integer
     */
    public $delete;
}
