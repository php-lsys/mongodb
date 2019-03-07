<?php
/**
 * lsys service
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Database;
class MongoDB extends \MongoDB\Client{
    /**
     * @var Config
     */
    protected $_config;
    private $_is_config;
    /**
     * Constructs a new Client instance.
     *
     * This is the preferred class for connecting to a MongoDB server or
     * cluster of servers. It serves as a gateway for accessing individual
     * databases and collections.
     *
     * Supported driver-specific options:
     *
     *  * typeMap (array): Default type map for cursors and BSON documents.
     *
     * Other options are documented in MongoDB\Driver\Manager::__construct().
     *
     * @see http://docs.mongodb.org/manual/reference/connection-string/
     * @see http://php.net/manual/en/mongodb-driver-manager.construct.php
     * @see http://php.net/manual/en/mongodb.persistence.php#mongodb.persistence.typemaps
     * @param string $uri           MongoDB connection string
     * @param array  $uriOptions    Additional connection string options
     * @param array  $driverOptions Driver-specific options
     * @throws Exception for parameter/option parsing errors
     */
    public function __construct(Config $config)
    {
        $this->_config=$config;
    }
    /**
     * init connect
     * @throws Exception
     */
    protected function _initManager(){
        if ($this->_is_config)return ;
        $config=$this->_config;
        $uri=$config->get("uri");
        $uriOptions=(array)$config->get("uriOptions",array());
        $driverOptions=(array)$config->get("driverOptions",array());
        try{
            parent::__construct($uri,$uriOptions,$driverOptions);
        }catch (InvalidArgumentException $e){
            throw new Exception($e->getmessage(),$e->getcode(),$e);
        }
        $this->_is_config=true;
    }
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::__debugInfo()
    */
    public function __debugInfo()
    {
        $this->_initManager();
        return parent::__debugInfo();
    }
    
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::__get()
    */
    public function __get($databaseName)
    {
        $this->_initManager();
        return parent::__get($databaseName);
    }
    
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::__toString()
    */
    public function __toString()
    {
        return $this->_config->get("uri");
    }
    
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::dropDatabase()
    */
    public function dropDatabase($databaseName, array $options = [])
    {
        $this->_initManager();
        return parent::dropDatabase($databaseName,  $options );
    }
    
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::getManager()
    */
    public function getManager()
    {
        $this->_initManager();
        return parent::getManager( );
    }
    
    /**
     * {@inheritDoc}
     * @see \MongoDB\Client::getReadConcern()
     */
    public function getReadConcern()
    {
        $this->_initManager();
        return parent::getReadConcern( );
    }
    /**
     * {@inheritDoc}
     * @see \MongoDB\Client::getReadPreference()
     */
    public function getReadPreference()
    {
        $this->_initManager();
        return parent::getReadPreference( );
    }
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::getTypeMap()
    */
    public function getTypeMap()
    {
        $this->_initManager();
        return parent::getTypeMap( );
    }
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::getWriteConcern()
    */
    public function getWriteConcern()
    {
        $this->_initManager();
        return parent::getWriteConcern( );
    }
    /**
     * {@inheritDoc}
     * @see \MongoDB\Client::listDatabases()
     */
    public function listDatabases(array $options = [])
    {
        $this->_initManager();
        return parent::listDatabases( $options );
    }
    /**
     * {@inheritDoc}
     * @see \MongoDB\Client::selectCollection()
     */
    public function selectCollection($databaseName, $collectionName, array $options = [])
    {
        $this->_initManager();
        return parent:: selectCollection($databaseName, $collectionName, $options );
    }
    /**
     * {@inheritDoc}
     * @see \MongoDB\Client::selectDatabase()
     */
    public function selectDatabase($databaseName, array $options = [])
    {
        $this->_initManager();
        return parent::selectDatabase($databaseName,$options);
    }
   /**
    * {@inheritDoc}
    * @see \MongoDB\Client::startSession()
    */
    public function startSession(array $options = [])
    {
        $this->_initManager();
        return parent::startSession($options);
    }
    /**
     * get default database.
     * @return Database
     */
    public function getDatabase()
    {
        $options=$this->_config->get("db.options",[]);
        $databaseName=$this->_config->get("db.name","__");
        return $this->selectDatabase($databaseName,$options);
    }
}