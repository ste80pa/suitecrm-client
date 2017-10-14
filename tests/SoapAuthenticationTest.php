<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Session;
use ste80pa\SuiteCRMClient\SoapClient;
use ste80pa\SuiteCRMClient\Client;

/**
 *
 * @author Stefano Pallozzi
 */
final class SoapAuthenticationTest extends TestCase
{

    /**
     * @covers ste80pa\SuiteCRMClient\SoapClient::__construct
     * @covers ste80pa\SuiteCRMClient\Client::login
     */
    public function testLogin()
    {
        $session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        
        $client = new SoapClient($session);
        $client->login();
        
        $this->assertNotEmpty($session->getId());
        $this->assertEquals(Session::RESUMED, $session->getStatus());
        
        return $client;
    }

    /**
     * @covers ste80pa\SuiteCRMClient\Client::logout
     * @covers ste80pa\SuiteCRMClient\SoapClient::logout
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
