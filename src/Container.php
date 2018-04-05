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

    public function toArray()
    {
        return array_filter((array) $this);
    }

    public function attachNetwork($host, $network)
    {
        ``
    }
}
