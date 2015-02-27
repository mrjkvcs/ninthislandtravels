<?php session_start();

require 'vendor/autoload.php';
require('config/database.php');

use App\Payment;

if (isset($_POST) and !empty($_POST))
{
    foreach ($_POST as $key => $value)
    {
        if ( ! findMe($key, 'submit')) $_SESSION['data'][$key] = $value;
    }

    $payment = new Payment($_SESSION['data']['product_id']);
    $payment->payPal();
}

if (isset($_GET['token']))
{
    $payment = new Payment($_SESSION['data']['product_id']);
    $payment->success();
}

