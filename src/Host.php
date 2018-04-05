<?php 

namespace DockerHost;

class Host
{
    public $id;

    public $address;

    public $name;

    public function __construct($address)
    {
        $this->address = $address;
    }

    public function createNetwork($network)
    {
        `docker -H {$this->address} network create -d {$network->type} {$network->name}`;
    }

    public function addContainer($container)
    {
        `docker -H {$this->address} run --name={$container->name} -t -d -m {$container->memory} --network={$container->network->name} {$container->image}`;
    }

    public function getStats()
    {
        $raw = `docker -H {$this->address} stats --no-stream \
  --format "{\"container\": \"{{ .Container }}\",\"containerName\": \"{{ .Name }}\", \"memory\": { \"raw\": \"{{ .MemUsage }}\", \"percent\": \"{{ .MemPerc }}\"}, \"netIo\": \"{{ .NetIO }}\",\"blockIo\": \"{{ .BlockIO }}\",\"cpu\": \"{{ .CPUPerc }}\"}"`;
        return array_map('json_decode', array_filter(explode("\n", $raw)));
    }

    public function getList()
    {
        return json_decode(`curl --no-buffer -XGET http://{$this->address}/containers/json`);
    }

    public function getIp($container)
    {
        return `docker -H {$this->address} inspect -f "{{ .NetworkSettings.IPAddress }}" {$container->name}`;
    }
}
