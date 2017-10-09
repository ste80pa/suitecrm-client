<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class GetNoteAttachmentRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var string
     */
    public $id;
}
