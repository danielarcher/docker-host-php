<?php 

require 'vendor/autoload.php';

use DockerHost\Container;
use DockerHost\Database;
use DockerHost\Host;
use DockerHost\Manager;
use DockerHost\User;

$db = (new Database())->getConnection();

$stmt = $db->prepare('SELECT * FROM Hosts');
$stmt->execute();
$hosts = $stmt->fetchAll(\PDO::FETCH_CLASS, Host::class);

$images = ['php:7.2-apache', 'php:5.6-apache', 'mysql:5.6', 'alpine'];
$plans = ['128M', '256M', '512M', '1G'];

if (isset($_POST['action']) && $_POST['action'] == 'newContainer') {
    
    #$user = new User();

    #$host = new Host();
    #$domain = new Domain;
    

    $container = new Container();
    $container->image = $_POST['image'];
    $container->memory = $_POST['plan'];
    $container->name = $_POST['name'];
    $db->insert('Containers', $container->toArray());

    #$manager = new Manager($db);
    #$manager->bindNewContainer($host, $container, $user, $network);
    #$manager->createContract($container, $user);
    #$manager->bindProxyDomain($domain, $container);
}

if ($_POST && $_POST['action'] == 'newHost') {
    $host = new Host();
    $host->address = $_POST['address'];
    $host->name = $_POST['name'];
    $db->insert('Hosts', $host->toArray());
}

if ($_GET['host']) {
    $stmt = $db->prepare('SELECT * FROM Hosts WHERE id = ?');
    $stmt->execute($_GET['host']);
    $selectedHost = $stmt->fetch(\PDO::FETCH_CLASS, Host::class);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Docker Host</title>
    </head>
    <body>
        <h1>My Hosts</h1>
        <ul>
            <?php foreach ($hosts as $host): ?>
                <li><a href="?host=<?php echo $host->id ?>"><?php echo $host->name ?></a></li>
            <?php endforeach ?>
        </ul>
        <fieldset>
            <legend>New Host</legend>
            <form method="post" action="">
                <input type="hidden" name="action" value="newHost">
                <p>Name: <input type="text" name="name"></p>
                <p>Address: <input type="text" name="address"></p>
                <p><input type="submit" value="Send"></p>
            </form>
        </fieldset>

        <?php if (isset($_GET['host'])): ?>
        <h1>My Containers</h1>
        <table width="100%" border="1">
            <tr>
                <th>Container</th>
                <th>Memory</th>
                <th>Net</th>
                <th>Cpu</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($stats as $container): ?>
            <tr>
                <td><?php echo $container->containerName ?> (<?php echo $container->container ?>)</td>
                <td><?php echo $container->memory->raw ?> (<?php echo $container->memory->percent ?>)</td>
                <td><?php echo $container->netIo ?></td>
                <td><?php echo $container->cpu ?></td>
                <td>
                    <a href="?host=<?php echo $_GET['host'] ?>&container=<?php echo $container->container ?>&action=start">Start</a>
                    <a href="?host=<?php echo $_GET['host'] ?>&container=<?php echo $container->container ?>&action=stop">Stop</a>
                    <a href="?host=<?php echo $_GET['host'] ?>&container=<?php echo $container->container ?>&action=destroy">Destroy</a>
                </td>
            </tr>
            <?php endforeach ?>
                
        </table>
        <fieldset>
            <legend>Novo Containers</legend>
            <form method="post" action="">
                <input type="hidden" name="host" value="<?php echo $_GET['host'] ?>">
                <input type="hidden" name="action" value="newContainer">
                <p>Name: <input type="text" name="name"></p>
                <p>Image:
                    <select name="image">
                        <?php foreach ($images as $image): ?>
                            <option value="<?php echo $image ?>"><?php echo $image ?></option>
                        <?php endforeach ?>
                    </select>
                </p>
                <p>Plan:
                    <select name="plan">
                        <?php foreach ($plans as $plan): ?>
                            <option value="<?php echo $plan ?>"><?php echo $plan ?></option>
                        <?php endforeach ?>
                    </select>
                </p>
                <p><input type="submit" value="Send"></p>
            </form>
        </fieldset>
        <?php endif ?>

    </body>
</html>
