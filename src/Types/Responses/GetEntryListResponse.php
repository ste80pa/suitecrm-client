<?php
namespace ste80pa\SuiteCRMClient\Types\Responses;

use ste80pa\SuiteCRMClient\Types\BaseResponse;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetEntryListResponse extends BaseResponse {
    /**
     * @var integer
     */
    public $result_count;

    /**
     * @var integer
     */
    public $total_count;

    /**
     * @var integer
     */
    public $next_offset;

    /**
     * @var array
     */
    public $entry_list = array();
}