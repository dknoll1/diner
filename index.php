<?php
/* Daniel Knoll
 * January 2024
 * https://dknoll.greenriverdev.com/328/diner/
 * this is my controller for the diner app
 */

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
// instantiate fat-free framework (f3)
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    //echo "My Diner";
    //display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /breakfast', function() {
//    echo "Breakfast";
//    display  view page
    $view = new Template();
    echo $view->render('views/breakfastmenu.html');
});

$f3->route('GET|POST /order1', function($f3) {
//    echo "Breakfast";


    //if form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $food = $_POST['food'];
        $meal = $_POST['meal'];

        $f3->set('SESSION.food', $food);
        $f3->set('SESSION.meal', $meal);

        $f3->reroute('order2');
    }

//    display  view page
    $view = new Template();
    echo $view->render('views/order-form-1.html');
});

$f3->route('GET|POST /order2', function($f3) {
//    echo "Breakfast";


    //if form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $food = $_POST['food'];
        $meal = $_POST['meal'];
        $condiment = $_POST['conds'];

        $f3->set('SESSION.food', $food);
        $f3->set('SESSION.meal', $meal);
        $f3->set('SESSION.conds', $condiment);

        $f3->reroute('summary');
    }

    $f3->set('condiments', getCondiments());

//    display  view page
    $view = new Template();
    echo $view->render('views/order-form-2.html');
});

$f3->route('GET /summary', function() {
//    echo "Breakfast";
//    display  view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// run f3
$f3->run();
