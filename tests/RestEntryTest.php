<?php
require_once('EntryTest.php');

use ste80pa\SuiteCRMClient\RestClient;
use ste80pa\SuiteCRMClient\Session;

/**
 * @author Stefano Pallozzi
 */
final class RestEntryTest extends EntryTest
{
    /**
     * @covers ste80pa\SuiteCRMClient\RestClient::getEntryList
     * {@inheritDoc}
     * @see AuthenticatedTest::initClient()
     */
	public function initClient(Session $session)
	{
		return new RestClient($session);	
	}
}