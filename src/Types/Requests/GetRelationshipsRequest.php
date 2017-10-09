<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetRelationshipsRequest extends BaseRequest {
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
     * @var string
     */
    public $related_module_query;
    /**
     * @var mixed
     */
    public $related_fields;
    /**
     * @var mixed
     */
    public $related_module_link_name_to_fields_array;
    /**
     * @var integer
     */
    public $deleted;
    /**
     * @var string
     */
    public $order_by;
    /**
     * @var integer
     */
    public $offset;
    /**
     * @var integer
     */
    public $limit;
}
