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
    public function __construct($return = 0)
    {
        $this->return = $return;
    }

    /**
     *
     * @var integer
     */
    public $return = 0;

    /**
     *
     * {@inheritdoc}
     * @see \ste80pa\SuiteCRMClient\Types\BaseResponse::fromData()
     */
    public function fromData($return = 0)
    {
        $this->return = $return;
        return $this;
    }
}
