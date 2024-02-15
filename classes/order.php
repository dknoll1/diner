<?php

/**
 *  The Order class represents a food order for the GRC Diner
 * @author Daniel Knoll
 * @copyright 2024
 */
class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Default constructor instantiates an Order object
     * new Order()
     * new Order("Tacos")
     * new Order("tacos, "lunch")
     * new Order("tacos", "lunch", "salsa, guacamole")
     * @param $food
     * @param $meal
     * @param $condiments
     */
    public function __construct($food="", $meal="", $condiments=array(""))
    {
        $this->_food = $food;
        $this->_meal = $meal;
        $this->_condiments = $condiments;
    }


    /**
     * return food
     * @return string
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * set the food
     * @param string $food
     */
    public function setFood($food): void
    {
        $this->_food = $food;
    }

    /**
     * get the meal
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * set the meal
     * @param string $meal
     */
    public function setMeal($meal): void
    {
        $this->_meal = $meal;
    }

    /**
     * return the condiments
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * set the condiments
     * @param string $condiments
     */
    public function setCondiments($condiments): void
    {
        $this->_condiments = $condiments;
    }
}