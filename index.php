<?php 

require 'vendor/autoload.php';

use DockerHost\Container;
use DockerHost\Host;
use DockerHost\Manager;
use DockerHost\User;

$host1 = new Host('host1:2375');
$host2 = new Host('host2:2375');

$user = new User('daniel', 'my-credit-cart');
$container = new Container('php:7.2-apache', '128M', 'my-container-name-'.mt_rand());
$manager = new Manager($user);
#$manager->addContainer($container, $host2);

echo '<pre>';
print_r($host2->getStats());
print_r($host2->getIp($container));
print_r($host2->getList());