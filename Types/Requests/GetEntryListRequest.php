<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetEntryListRequest extends BaseRequest {
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
    public $query;
    /**
     * @var string
     */
    public $order_by;
    /**
     * @var integer
     */
    public $offset;
    /**
     * @var mixed
     */
    public $select_fields;
    /**
     * @var mixed
     */
    public $link_name_to_fields_array;
    /**
     * @var integer
     */
    public $max_results;
    /**
     * @var integer
     */
    public $deleted;
    /**
     * @var boolean
     */
    public $favorites;
}
