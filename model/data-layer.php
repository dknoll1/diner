<?php

/*
 * this file represents my data layer for the diner app
 */

class DataLayer
{
    static function getMeals()
    {
        return array('breakfast', 'lunch', 'dinner');
    }

    static function getCondiments()
    {
        return array('ketchup', 'mustard', 'siracha');
    }

}