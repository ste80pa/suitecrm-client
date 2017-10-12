<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\SoapClient;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;
use ste80pa\SuiteCRMClient\Types\Responses\LogoutResponse;
/**
 * @author Stefano Pallozzi
 */
final class SoapAuthenticationTest extends TestCase
{
    /**
     * 
     * @var SoapClient
     */
	private $client = null;
	/**
	 * 
	 * {@inheritDoc}
	 * @see \PHPUnit\Framework\TestCase::setUp()
	 */
	public function setUp()
	{
		$this->client = new SoapClient($GLOBALS['suitecrm_host']);
	}
	/**
	 * 
	 * {@inheritDoc}
	 * @see \PHPUnit\Framework\TestCase::tearDown()
	 */
	public function tearDown()
	{
		$this->client->Logout();
	}
    /**
     * 
     */
	public function testLogin()
	{
		$request = new LoginRequest($GLOBALS['suitecrm_username'],$GLOBALS['suitecrm_password']);
		$response = $this->client->Login($request);		
		$this->assertEquals(get_class($response), LoginResponse::class);	
	}
    /**
     * 
     */
	public function testLogout()
	{
		$response = $this->client->Logout();		
		$this->assertEquals(get_class($response), LogoutResponse::class);
	}
}
