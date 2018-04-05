<?php 

namespace DockerHost;

use DockerHost\Database;

class Host
{
    public $id;

    public $address;

    public $name;

    public function __construct($id = null)
    {
        if ($id) {
            $db = (new Database())->getConnection();
            $stmt = $db->prepare('SELECT * FROM Hosts WHERE id = ?');
            $stmt->execute([$id]);

            $host = current($stmt->fetchAll(\PDO::FETCH_CLASS, self::class));

            $this->id = $host->id;
            $this->address = $host->address;
            $this->name = $host->name;
        }
    }

    public function createNetwork($network)
    {
        `docker -H {$this->address} network create -d {$network->type} {$network->name}`;
    }

    public function addContainer($container)
    {
        `docker -H {$this->address} run --name={$container->name} -t -d -m {$container->memory} {$container->image}`;
    }

    public function getStats()
    {
        $raw = `docker -H {$this->address} stats -a --no-stream --format "{\"container\": \"{{ .Container }}\",\"containerName\": \"{{ .Name }}\", \"memory\": { \"raw\": \"{{ .MemUsage }}\", \"percent\": \"{{ .MemPerc }}\"}, \"netIo\": \"{{ .NetIO }}\",\"blockIo\": \"{{ .BlockIO }}\",\"cpu\": \"{{ .CPUPerc }}\"}"`;
        $colectedData = array_map('json_decode', array_filter(explode("\n", $raw)));

        return $colectedData;
    }

    public function getList()
    {
        return json_decode(`curl --no-buffer -XGET http://{$this->address}/containers/json`);
    }

    public function getIp($container)
    {
        return `docker -H {$this->address} inspect -f "{{ .NetworkSettings.IPAddress }}" {$container->name}`;
    }

    public function toArray()
    {
        return array_filter((array) $this);
    }

    public function start($containerHash)
    {
        return `docker -H {$this->address} start {$containerHash}`;
    }

    public function stop($containerHash)
    {
        return `docker -H {$this->address} stop {$containerHash}`;
    }

    public function remove($containerHash, $force = false)
    {
        $force = ($force) ? '-f' : '';
        return `docker -H {$this->address} rm {$force} {$containerHash}`;
    }
}
