<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class GetEntryRequest extends BaseRequest
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
     * The ID of the record to retrieve.
     *
     * @var string
     */
    public $id;

    /**
     * The list of fields to be returned in the results.
     * Specifying an empty array will return all fields.
     *
     * @var mixed
     */
    public $select_fields = array();

    /**
     * A list of link names and the fields to be returned for each link.
     * 
     * @var mixed
     */
    public $link_name_to_fields_array;

    /**
     * Flag the record as a recently viewed item.
     * 
     * @var boolean
     */
    public $track_view;
}
