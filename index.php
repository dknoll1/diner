<?php

// This is my controller

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');

// Instantiate F3 Base Class
$f3 = Base::instance();

// Define a default route (328/diner)
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/diner-home.html');
});

$f3->route('GET /breakfast', function() {

    $view = new Template();
    echo $view->render('views/breakfast.html');

});
$f3->route('GET /breakfast', function() {

    $view = new Template();
    echo $view->render('views/breakfast.html');

});
$f3->route('GET /order1', function() {

    $view = new Template();
    echo $view->render('views/order-form1.html');

});

// Run Fat Free
$f3->run();

?>