<?php 

namespace DockerHost;

class Database
{
    public function __construct()
    {
    }

    public function getConnection()
    {
        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = array(
            'dbname' => 'dockerhost',
            'user' => 'dockerhost',
            'password' => 'dockerhost',
            'host' => 'mysql.dockerhost.com',
            'driver' => 'pdo_mysql',
        );
        return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }
}