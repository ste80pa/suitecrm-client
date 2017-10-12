<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\RestClient;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;
use ste80pa\SuiteCRMClient\Types\Responses\LogoutResponse;
use ste80pa\SuiteCRMClient\Client;
/**
 * @author Stefano Pallozzi
 */
final class AuthenticationTest extends TestCase
{
    /**
     * 
     * @var Client
     */
	private $client = null;
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \PHPUnit\Framework\TestCase::setUp()
	 */
	public function setUp()
	{
		$this->client = new RestClient($GLOBALS['suitecrm_host']);		
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
