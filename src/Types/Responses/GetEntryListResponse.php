<?php
namespace ste80pa\SuiteCRMClient\Types\Responses;

use ste80pa\SuiteCRMClient\Types\BaseResponse;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class GetEntryListResponse extends BaseResponse
{

    /**
     *
     * @var integer
     */
    public $result_count = 0;

    /**
     *
     * @var integer
     */
    public $total_count = 0;

    /**
     *
     * @var integer
     */
    public $next_offset = 0;

    /**
     *
     * @var array
     */
    public $entry_list = array();
}