<?php
namespace ste80pa\SuiteCRMClient\Types\Requests;

use ste80pa\SuiteCRMClient\Types\BaseRequest;

/**
 *
 * @author Stefano Pallozzi
 *
 */
class SetCampaignMergeRequest extends BaseRequest {
    /**
     * @var string
     */
    public $session;
    /**
     * @var mixed
     */
    public $targets;
    /**
     * @var string
     */
    public $campaign_id;
}
