<?php 

namespace DockerHost;

class Container
{
    public $network;

    public function __construct($image, $memory, $name)
    {
        $this->image = $image;
        $this->memory = $memory;
        $this->name = $name;
    }

    public function addNetwork($network)
    {
        $this->network = $network;
    }
}
