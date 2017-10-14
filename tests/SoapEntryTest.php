<?php
require_once('EntryTest.php');

use ste80pa\SuiteCRMClient\Session;
use ste80pa\SuiteCRMClient\SoapClient;

/**
 * @author Stefano Pallozzi
 */
final class SoapEntryTest extends EntryTest
{
   /**
    * @covers ste80pa\SuiteCRMClient\SoapClient::getEntryList
    * {@inheritDoc}
    * @see AuthenticatedTest::initClient()
    */
	public function initClient(Session $session)
	{
		return new SoapClient($session);	
	}
}