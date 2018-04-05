<?php 

namespace DockerHost;

class Manager
{
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function addContainer($container, $host)
    {
        $host->createNetwork($this->user->getNetwork());
        $container->addNetwork($this->user->getNetwork());

        $host->addContainer($container);
    }
}

