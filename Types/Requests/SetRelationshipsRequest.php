<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class SetRelationshipsRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var mixed
     */
    public $module_names;
    /**
     * @var mixed
     */
    public $module_ids;
    /**
     * @var mixed
     */
    public $link_field_names;
    /**
     * @var mixed
     */
    public $related_ids;
    /**
     * @var mixed
     */
    public $name_value_lists;
    /**
     * @var mixed
     */
    public $delete_array;
}
