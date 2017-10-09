<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetEntriesRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var string
     */
    public $module_name;
    /**
     * @var mixed
     */
    public $ids;
    /**
     * @var mixed
     */
    public $select_fields;
    /**
     * @var mixed
     */
    public $link_name_to_fields_array;
    /**
     * @var boolean
     */
    public $track_view;
}