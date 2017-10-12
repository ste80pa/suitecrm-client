<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\Client;

/**
 *
 * @author Stefano Pallozzi
 */
abstract class AuthenticatedTest extends TestCase
{

    /**
     * 
     * @var Client
     */
    protected $client = null;
    
    /**
     * 
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp()
    {
        $this->client = $this->initClient();
        $request = new LoginRequest($GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        $response = $this->client->Login($request);
    }

    /**
     * 
     */
    abstract protected function initClient();

    /**
     * 
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::tearDown()
     */
    public function tearDown()
    {
        $this->client->Logout();
    }
}