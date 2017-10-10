<?php
require_once('EntryTest.php');

use ste80pa\SuiteCRMClient\RestClient;

/**
 * @author Stefano Pallozzi
 */
final class RestEntryTest extends EntryTest
{
	public function initClient()
	{
		return new RestClient($GLOBALS['suitecrm_rest_host']);	
	}
}