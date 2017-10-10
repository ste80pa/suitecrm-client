<?php
require_once('EntryTest.php');

use ste80pa\SuiteCRMClient\SoapClient;

/**
 * @author Stefano Pallozzi
 */
final class SoapEntryTest extends EntryTest
{
	public function initClient()
	{
		return new SoapClient($GLOBALS['suitecrm_soap_host']);	
	}
}