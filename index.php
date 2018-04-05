<?php 

require 'vendor/autoload.php';

use DockerHost\Container;
use DockerHost\Host;
use DockerHost\Manager;
use DockerHost\User;

$hosts = ['host1:2375', 'host2:2375'];
$images = ['php:7.2-apache', 'php:5.6-apache', 'mysql:5.6', 'alpine'];
$plans = ['128M', '256M', '512M', '1G'];

if (isset($_GET['host'])) {
    $host = new Host('host1:2375');
    $stats = $host->getStats();
}

if (isset($_POST['action']) && $_POST['action'] == 'new') {
    $user = new User('daniel', 'my-credit-cart');

    $host = new Host($_POST['host']);
    $container = new Container($_POST['image'], $_POST['plan'], $_POST['name']);
    $manager = new Manager($user);
    $manager->addContainer($container, $host);
}

echo '<pre>';
#$stats = $host->getStats();
#print_r($host2->getIp($container));
#print_r($host2->getList());
echo '</pre>';

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
                <li><a href="?host=<?php echo $host ?>"><?php echo $host ?></a></li>
            <?php endforeach ?>
        </ul>

        <?php if (isset($_GET['host'])): ?>
        <h1>My Containers</h1>
        <pre>
            <?php echo $stats ?>
        </pre>
        <table>
            <tr>
                <th></th>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <fieldset>
            <legend>Novo Containers</legend>
            <form method="post" action="">
                <input type="hidden" name="host" value="<?php echo $_GET['host'] ?>">
                <input type="hidden" name="action" value="new">
                <p>Name: <input type="text" name="name"></p>
                <p>Image:
                    <select name="image">
                        <?php foreach ($images as $image): ?>
                            <option value="image"><?php echo $image ?></option>
                        <?php endforeach ?>
                    </select>
                </p>
                <p>Plan:
                    <select name="plan">
                        <?php foreach ($plans as $plan): ?>
                            <option value="plan"><?php echo $plan ?></option>
                        <?php endforeach ?>
                    </select>
                </p>
                <p><input type="submit" value="Send"></p>
            </form>
        </fieldset>
        <?php endif ?>

    </body>
</html>
