<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class GetEntryListRequest extends BaseRequest
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
     * The SQL WHERE clause without the word "where".
     * You should remember to specify the table name for the fields to avoid any ambiguous column errors.
     *
     * @var string
     */
    public $query;

    /**
     * The SQL ORDER BY clause without the phrase "order by".
     *
     * @var string
     */
    public $order_by;

    /**
     * The record offset from which to start.
     *
     * @var integer
     */
    public $offset = 0;

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
    public $link_name_to_fields_array = array();

    /**
     * The maximum number of results to return.
     * 
     * @var integer
     */
    public $max_results;

    /**
     * If deleted records should be included in the results.
     * 
     * @var integer
     */
    public $deleted;

    /**
     * If only records marked as favorites should be returned.
     * 
     * @var boolean
     */
    public $favorites;
}
