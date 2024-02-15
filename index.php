<?php
/* Tina Ostrander
 * January 2024
 * https://tostrander.greenriverdev.com/328/diner/
 * This is my CONTROLLER for the Diner app
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');

////Test my order class
//$order = new Order("tacos","breakfast");
//var_dump($order);
// test my datalayer class

// Instantiate Fat-Free framework (F3)
$f3 = Base::instance(); //static method
$con = new Controller($f3);
global $con;

// Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {
    //echo "Breakfast";

    // Display a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Define a order form 1 route
$f3->route('GET|POST /order1', function($f3) {
    $GLOBALS['con']->order1();
});

// Define a order form 2 route
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['con']->order2();
});

// Define an order summary route
$f3->route('GET /summary', function() {
    //echo "Thank you for your order!";

    // Display a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// Run Fat-Free
$f3->run(); //instance method
