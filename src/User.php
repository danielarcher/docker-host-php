<?php 

namespace DockerHost;

use DockerHost\Network;

class User
{
    public $network;

    public function getNetwork()
    {
        if (false == $this->network) {
            $this->network = new Network('bridge', 'encrypted', 'random-name-'.mt_rand());
        }

        return $this->network;
    }
}
