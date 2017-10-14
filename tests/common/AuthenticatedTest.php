<?php
use PHPUnit\Framework\TestCase;
use ste80pa\SuiteCRMClient\Client;
use ste80pa\SuiteCRMClient\Session;

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
     * @var Session
     */
    protected $session;

    /**
     * @coversNothing
     * 
     * @param string $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->session = new Session($GLOBALS['suitecrm_host'], $GLOBALS['suitecrm_username'], $GLOBALS['suitecrm_password']);
        $this->client = $this->initClient($this->session);
        $this->client->login();
    }

    /**
     * @coversNothing
     */
    public function __destruct()
    {
        $this->client->logout();
    }

    /**
     * @coversNothing
     * 
     * @param Session $session
     */
    abstract protected function initClient(Session $session);
}