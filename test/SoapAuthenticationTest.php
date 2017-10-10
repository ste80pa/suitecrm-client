<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\GetRelationshipsRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\Types\Responses\LogoutResponse;
use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;
use ste80pa\SuiteCRMClient\SoapClient;
/**
 * @author Stefano Pallozzi
 */
final class SoapAuthenticationTest extends TestCase
{
	private $client = null;

	public function setUp()
	{
		$this->client = new SoapClient($GLOBALS['suitecrm_soap_host']);
	}
	
	public function tearDown()
	{
		$this->client->Logout();
	}

	public function testLogin()
	{
		$request = new LoginRequest($GLOBALS['suitecrm_username'],$GLOBALS['suitecrm_password']);
		$response = $this->client->Login($request);		
		$this->assertEquals(get_class($response), LoginResponse::class);	
	}

	public function testLogout()
	{
		$response = $this->client->Logout();		
		$this->assertEquals(get_class($response), LogoutResponse::class);
	}
}
