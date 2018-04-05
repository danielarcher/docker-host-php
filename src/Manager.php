<?php 

namespace DockerHost;

class Manager
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function bindNewContainer($host, $container, $user, $network)
    {
        $host->createNetwork($network);
        $container->attachNetwork($host, $network);

        $user->addContainer($container);
        $host->addContainer($container);
    }

    public function createContract($container, $user)
    {
        #$contract = new Contract();
        #$contract->value = $container->value;
        #$contract->userId = $user->id;
        #$contract->save();
    }

    public function bindProxyDomain($domain, $container)
    {
        #$proxyRule = new ProxyRule();
        #$proxyRule->attachDomain($domain->address, $container->ip);
    }

    public function addContainer($container, $host)
    {

        $host->createNetwork($this->user->getNetwork());
        $container->addNetwork($this->user->getNetwork());

        $host->addContainer($container);
    }
}

