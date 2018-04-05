<?php 

namespace DockerHost;

class Network
{
    public function __construct($type, $encryption, $name)
    {
        $this->type = $type;
        $this->encryption = $encryption;
        $this->name = $name;
    }
}
