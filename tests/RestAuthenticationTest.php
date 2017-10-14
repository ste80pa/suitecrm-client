<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Client;
use ste80pa\SuiteCRMClient\RestClient;
use ste80pa\SuiteCRMClient\Session;

/**
 * @author Stefano Pallozzi
 */
final class RestAuthenticationTest extends TestCase
{
    /**
     * @covers ste80pa\SuiteCRMClient\Client::login
     * @covers ste80pa\SuiteCRMClient\RestClient::login
     */
    public function testLogin()
    {
        $session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        
        $client = new RestClient($session);
        $client->login();
        
        $this->assertNotEmpty($session->getId());
        $this->assertEquals(Session::RESUMED, $session->getStatus());
        
        return $client;
    }
    
    /**
     * @covers ste80pa\SuiteCRMClient\Client::logout
     * @covers ste80pa\SuiteCRMClient\RestClient::logout
     * @depends testLogin
     */
    public function testLogout(Client $client)
    {
        $client->Logout();
        
        $session = $client->getSession();
        $this->assertNull($session->getId());
        $this->assertEquals(Session::UNKNOWN, $session->getStatus());
    }
}
