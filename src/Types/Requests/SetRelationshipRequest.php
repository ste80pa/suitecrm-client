<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class SetRelationshipRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var string
     */
    public $module_name;
    /**
     * @var string
     */
    public $module_id;
    /**
     * @var string
     */
    public $link_field_name;
    /**
     * @var mixed
     */
    public $related_ids;
    /**
     * @var mixed
     */
    public $name_value_list;
    /**
     * @var integer
     */
    public $delete;
}
