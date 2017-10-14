<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Session;
use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;

/**
 *
 * @author Stefano Pallozzi
 */
final class SessionTest extends TestCase
{

    /**
     *
     * @var string
     */
    const TEST_URL = 'http://testhost.localhost';

    /**
     *
     * @var string
     */
    const TEST_USER = 'test';

    /**
     *
     * @var string
     */
    const TEST_PASSWORD = 'test_password';

    /**
     *
     * @var string
     */
    const VERSION = 'v4_1';

    /**
     *
     * @return \ste80pa\SuiteCRMClient\Types\Responses\LoginResponse
     */
    private static function MockLoginResponse()
    {
        $response = new LoginResponse();
        
        $response->id = '1234567890';
        $response->user_id = 'test';
        $response->user_name = self::TEST_USER;
        
        return $response;
    }

    /**
     * @covers ste80pa\SuiteCRMClient\Session::__construct
     * @covers ste80pa\SuiteCRMClient\Session::getStatus
     * @covers ste80pa\SuiteCRMClient\Session::getUrl
     * @covers ste80pa\SuiteCRMClient\Session::getUsername
     * @covers ste80pa\SuiteCRMClient\Session::getPassword
     * @covers ste80pa\SuiteCRMClient\Session::getEndpointVersion
     * @covers ste80pa\SuiteCRMClient\Session::usesStorage
     * @covers ste80pa\SuiteCRMClient\Session::getId
     * 
     */
    public function testCreateSession()
    {
        $session = new Session(self::TEST_URL, self::TEST_USER, self::TEST_PASSWORD, self::VERSION, true);
        @unlink($session->getSessionFile());
        
        $this->assertEquals(Session::UNKNOWN, $session->getStatus());
        $this->assertEquals(self::TEST_URL, $session->getUrl());
        $this->assertEquals(self::TEST_USER, $session->getUsername());
        $this->assertEquals(self::TEST_PASSWORD, $session->getPassword());
        $this->assertEquals(self::VERSION, $session->getEndpointVersion());
        $this->assertTrue($session->usesStorage());
        $this->assertNull($session->getId());
        
       return $session;
    }
    
    /**
     * 
     * @depends testCreateSession
     * @param Session $session
     */
    public function testNotSavedSession(Session $session)
    {        
        $this->assertFalse($session->loadSession());
        $this->assertEquals(Session::UNKNOWN, $session->getStatus());
        return $session;
    }
    /**
     * @depends testNotSavedSession
     * @covers ste80pa\SuiteCRMClient\Session::saveSession
     * @param Session $session
     */
    public function testSaveSession(Session $session)
    {        
        $loginResponse = self::MockLoginResponse();
        
        $session->saveSession($loginResponse);
        
        $this->assertFileExists($session->getSessionFile());
        $this->assertEquals(Session::RESUMED, $session->getStatus());
        $this->assertEquals($loginResponse->id, $session->getId());
        return $session;
    }
    
    /**
     * @depends testSaveSession
     * @covers ste80pa\SuiteCRMClient\Session::loadSession
     * @param Session $session
     */
    public function testLoadSavedSession(Session $session)
    {
        $loginResponse = self::MockLoginResponse();
        
        $this->assertTrue($session->loadSession());
        $this->assertEquals(Session::RESUMED, $session->getStatus());
        $this->assertNotNull($session->getId());
        $this->assertEquals($loginResponse->id, $session->getId());
        return $session;
    }
    
    /**
     * @depends testSaveSession
     * @covers ste80pa\SuiteCRMClient\Session::close
     * @param Session $session
     */
    public function testCloseSession(Session $session)
    {
        $session->close(); 
        
        $this->assertNull($session->getId());
        $this->assertEquals(Session::UNKNOWN,$session->getStatus());
        $this->assertFileNotExists($session->getSessionFile());
        return $session;
    }
    
}