<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;

/**
 * @author Stefano Pallozzi
 */
abstract class AuthenticatedTest extends TestCase
{
        protected $client = null;

        public function setUp()
        {
                $this->client = $this->initClient(); 
                $request = new LoginRequest($GLOBALS['suitecrm_username'],$GLOBALS['suitecrm_password']);
                $response = $this->client->Login($request);     
        }
        
	abstract protected function initClient();

        public function tearDown()
        {
                $this->client->Logout();
        }
}