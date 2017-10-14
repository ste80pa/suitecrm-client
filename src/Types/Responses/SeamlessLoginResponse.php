<?php
namespace ste80pa\SuiteCRMClient\Types\Responses;

use ste80pa\SuiteCRMClient\Types\BaseResponse;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class SeamlessLoginResponse extends BaseResponse
{
    /**
     *
     * @param int $return
     */
    public function __construct($return)
    {
        $this->return = $return;
    }

    /**
     *
     * @var integer
     */
    public $return;
}
