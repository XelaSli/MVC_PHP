<?php
class Database
{
    
    
    static private $instance=null;
    private $connection;
    
    private $dsn = 'mysql:host=localhost;dbname=db_PHP_Rush_MVC;charset=utf8';
    private $username = '';
    private $password = '';
    
    private function __construct()
    {
        try{
            $this->connection = new PDO($this->dsn,$this->username,$this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection error:".$e->getMessage()."\n";
        }
    }
    
    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new Database();
            
        }
        return self ::$instance;
    }
    
    public function getConnection()
    {
        
        return $this->connection;
        
    }
    
}
