<?php

use Stripe\Charge;
use Stripe\Stripe;

require_once $_SERVER['DOCUMENT_ROOT'] . './harbStore/core/connection/init.php';
require_once(ROOT . DS . 'vendor/autoload.php');
Stripe::setApiKey(STRIPE_SKEY);

header('Content-Type: application/json');

Stripe::setVerifySslCerts(false);

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$herbid = $_GET['id'];
$user_id = $_GET['userid'];

$herbs = $db->query("SELECT * FROM `herbs` WHERE `id` = '{$herbid}'");
$herb = mysqli_fetch_assoc($herbs);
$price = (int)$herb['price'] * 100;
$date = date("Y-m-d H:i:s");

if (!isset($_POST['stripeToken']) || !isset($herbid)) {
    $_SESSION['error_mesg'] .= 'unknown error has occured during proccessing your request';
    redirect(PROOT . 'app' . DS . 'users' . DS . 'client' . DS . 'shopping.php');
}

$charge = Charge::create([
    "amount" => $price,
    "currency" => 'usd',
    "description" => $herb['descr'],
    "source" => $token,
]);

$db->query("UPDATE `shopping_cart` SET `paid` = 1, `paid_at`='{$date}',`email_at_buying`='{$email}' WHERE `herb_id` = '{$herbid}' AND `user_id` = '{$user_id}'");
$_SESSION['success_mesg'] .= 'Your herbical Product charged, we will ship it your address.';
redirect(PROOT . 'app' . DS . 'users' . DS . 'client' . DS . 'shopping.php');
