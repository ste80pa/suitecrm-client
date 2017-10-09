<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetModifiedRelationshipsRequest extends BaseRequest {
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
    public $related_module;
    /**
     * @var string
     */
    public $from_date;
    /**
     * @var string
     */
    public $to_date;
    /**
     * @var integer
     */
    public $offset;
    /**
     * @var integer
     */
    public $max_results;
    /**
     * @var integer
     */
    public $deleted;
    /**
     * @var string
     */
    public $module_user_id;
    /**
     * @var mixed
     */
    public $select_fields;
    /**
     * @var string
     */
    public $relationship_name;
    /**
     * @var string
     */
    public $deletion_date;
}
