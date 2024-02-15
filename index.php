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

// Define a default route
$f3->route('GET /', function() {
    //echo "My Diner";

    // Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
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
    //echo "Order Form Part I";

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // initialize variables
        $food = "";
        $meal = "";
        // Validate the data
        if (Validate::validFood($_POST['food'])) {
            $food = $_POST['food'];
        } else {
            $f3->set('errors["food"]', "Invalid food");
        }
        if (Validate::validMeal($_POST['meal']) and isset($_POST['meal'])) {
            $meal = $_POST['meal'];
        } else {
            $f3->set('errors["meal"]', "Invalid meal");
        }

        if(empty($f3->errors['food'])) {
            // instantiate an order object
            $order = new Order($food, $meal);
            // Put the data in the session array
            $f3->set('SESSION.order', $order);

            // Redirect to order2 route
            $f3->reroute('order2');
        }
    }

    // Get data from the model and add to the F3 "hive"
    $f3->set('meals', DataLayer::getMeals());

    // Display a view page
    $view = new Template();
    echo $view->render('views/order-form-1.html');
});

// Define a order form 2 route
$f3->route('GET|POST /order2', function($f3) {
    //echo "Order Form Part II";

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Validate the data
        if (isset($_POST['conds'])){
            $conds = implode(", ", $_POST['conds']);
        }
        else {
            $conds = "None selected";
        }

        // Put the data in the session array
        $f3->get('SESSION.order')->setCondiments($conds);

        // Redirect to summary route
        $f3->reroute('summary');

    }

    // Add data to the F3 "hive"
    $f3->set('condiments', DataLayer::getCondiments());

    // Display a view page
    $view = new Template();
    echo $view->render('views/order-form-2.html');

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
