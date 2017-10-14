<?php
namespace ste80pa\SuiteCRMClient;

use ste80pa\SuiteCRMClient\Types\Responses\LoginResponse;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class Session
{

    /**
     *
     * @var integer
     */
    const UNKNOWN = 0x00;

    /**
     *
     * @var integer
     */
    const RESUMED = 0x01;

    /**
     * Session id
     *
     * @var string
     */
    private $id;

    /**
     *
     * @var string
     */
    protected $url;

    /**
     *
     * @var string
     */
    protected $endpointVersion = 'v4_1';

    /**
     *
     * @var string
     */
    protected $storageFolder;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var boolean
     */
    protected $store;

    /**
     *
     * @var integer
     */
    protected $status = self::UNKNOWN;

    /**
     *
     * @var mixed
     */
    protected $info = null;

    /**
     *
     * @param string $url
     * @param string $username
     * @param string $password
     * @param string $endpointVersion
     * @param boolean $usesStorage
     */
    public function __construct($url, $username, $password, $endpointVersion = 'v4_1', $usesStorage = true)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->endpointVersion = $endpointVersion;
        $this->store = $usesStorage;
        
        if ($usesStorage) {
            $this->storageFolder = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'suitecrm-client' . DIRECTORY_SEPARATOR;
        }
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @return string
     */
    public function getStorageFolder()
    {
        return $this->storageFolder;
    }

    /**
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @return string
     */
    public function getEndpointVersion()
    {
        return $this->endpointVersion;
    }

    /**
     *
     * @return number
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @return boolean true if uses session stored on file system, false otherwise.
     */
    public function usesStorage()
    {
        return $this->store;
    }

    /**
     *
     * @param string $sessionPath
     */
    public function setSessionFolder($sessionPath)
    {
        $this->storageFolder = $sessionPath;
        
        return $this;
    }

    /**
     * Return an unique session file name for the session.
     *
     * @throws \Exception
     * @return string
     */
    public function getSessionFile()
    {
        $host = null;
        
        if (($host = parse_url($this->url, PHP_URL_HOST)) === false) {
            throw new \Exception(__CLASS__ . ':' . __FUNCTION__ . " URL ${url} malformed");
        }
        
        return $this->storageFolder . DIRECTORY_SEPARATOR . sha1("{$this->username}@{$host}", false);
    }

    /**
     * Attempt to load a previously stored session.
     * If this session was instatiated passing $usesStorage = false, this method will always return false.
     * If attempting to load alredy loaded session, nothing happens and this method will return true.
     *
     * @return boolean true on success false otherwise
     */
    public function loadSession()
    {
        if ($this->store === false)
            return false;
        
        if ($this->status === self::RESUMED)
            return true;
        
        $filename = $this->getSessionFile();
        
        if (! is_file($filename))
            return false;
        
        $this->info = json_decode(file_get_contents($filename), true);
        $this->id = $this->info['id'];
        $this->status = self::RESUMED;
        
        return true;
    }

    /**
     * Save session from login response
     *
     * @param LoginResponse $response
     * @throws \Exception
     */
    public function saveSession(LoginResponse $response)
    {
        if ($response->user_name != $this->username) {
            throw new \Exception("Session user does not match response user (\"{$this->username}\" != \"{$response->user_name})\".");
        }
        
        $this->id = $response->id;
        $this->info = $response->toArray();
        
        $this->status = self::RESUMED;
        
        if (! $this->store) {
            return;
        }
        
        if (! is_dir($this->storageFolder)) {
            
            if (file_exists($this->storageFolder)) {
                throw new \Exception("{$this->storageFolder} must be a directory");
            }
            if (! mkdir($this->storageFolder, 0755, true)) {
                throw new \Exception("unable to create {$this->storageFolder} folder.");
            }
        }
        
        $filename = $this->getSessionFile();
        
        $handle = fopen($filename, 'w');
        
        if ($handle === false) {
            throw new \Exception("Unable to store session into \"${filename}\".");
        }
        
        fwrite($handle, json_encode($response));
        fclose($handle);
    }

    /**
     */
    public function close()
    {
        $filename = $this->getSessionFile();
        
        if (is_file($filename)) {
            unlink($filename);
        }
        
        $this->info = null;
        $this->id = null;
        $this->status = self::UNKNOWN;
    }
}