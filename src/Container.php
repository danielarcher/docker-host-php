<?php 

namespace DockerHost;

class Container 
{
    public $id;

    public $hash;

    public $shortHash;

    public $name;

    public $image;

    public $memory;

    public $created;

    public function __construct($id = null)
    {
        if ($id) {
            $db = (new Database())->getConnection();
            $stmt = $db->prepare('SELECT * FROM Containers WHERE id = ?');
            $stmt->execute([$id]);

            $container = current($stmt->fetchAll(\PDO::FETCH_CLASS, self::class));
            
            $this->id = $container->id;
            $this->hash = $container->hash;
            $this->shortHash = $container->shortHash;
            $this->name = $container->name;
            $this->image = $container->image;
            $this->memory = $container->memory;
            $this->created = $container->created;
        }
    }

    public function toArray()
    {
        return array_filter((array) $this);
    }

    public function connectNetwork($host, $network)
    {
        `docker -H {$host->address} network connect {$network->name} {$this->name}`;
    }
}
