<?php

/**
 * 328/diner/controllers/controller.php
 * the controller class for my diner app
 */

class Controller
{
    private $_f3; //fat-free router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order1()
    {
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
                $this->_f3->set('errors["food"]', "Invalid food");
            }
            if (Validate::validMeal($_POST['meal']) and isset($_POST['meal'])) {
                $meal = $_POST['meal'];
            } else {
                $this->_f3->set('errors["meal"]', "Invalid meal");
            }

            if(empty($f3->errors['food'])) {
                // instantiate an order object
                $order = new Order($food, $meal);
                // Put the data in the session array
                $this->_f3->set('SESSION.order', $order);

                // Redirect to order2 route
                $this->_f3->reroute('order2');
            }
        }
        // Get data from the model and add to the F3 "hive"
        $this->_f3->set('meals', DataLayer::getMeals());

        // Display a view page
        $view = new Template();
        echo $view->render('views/order-form-1.html');
    }

        function order2()
        {
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
                $this->_f3->get('SESSION.order')->setCondiments($conds);

                // Redirect to summary route
                $this->_f3->reroute('summary');

            }

            // Add data to the F3 "hive"
            $this->_f3->set('condiments', DataLayer::getCondiments());

            // Display a view page
            $view = new Template();
            echo $view->render('views/order-form-2.html');

        }
}