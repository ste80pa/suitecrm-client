<?php
namespace ste80pa\SuiteCRMClient\Types\Responses;

use ste80pa\SuiteCRMClient\Types\BaseResponse;
/**
 *
 * @author Stefano Pallozzi
 *
 */
class LoginResponse extends BaseResponse {   
    /**
     * @var string
     */
    public $id = null;
    /**
     * @var string
     */
    public $module_name = null;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $user_name;
    /**
     * @var string
     */
    public $user_language;
    /**
     * @var string
     */
    public $user_currency_id;
    /**
     * @var string
     */
    public $user_is_admin;
    /**
     * @var string
     */
    public $user_default_team_id;
    /**
     * @var string
     */
    public $user_default_dateformat;
    /**
     * @var string
     */
    public $user_default_timeformat;
    /**
     * @var string
     */
    public $user_number_seperator;
    /**
     * @var string
     */
    public $user_decimal_seperator;
    /**
     * @var string
     */
    public $mobile_max_list_entries; 
    /**
     * @var string
     */
    public $mobile_max_subpanel_entries; 
    /**
     * @var string
     */
    public $user_currency_name;
}