<?php

    function get_meals() {
        global $db;
        $query = 'SELECT * FROM meals ORDER BY mealID';
        $statement = $db->prepare($query);
        $statement->execute();
        $meals = $statement->fetchAll();
        $statement->closeCursor();
        return $meals;
    }

    function get_meal_name($meal_id) {
        if (!$meal_id) {
            return "All Meals";
        }
        global $db;
        $query = 'SELECT * FROM meals WHERE mealID = :meal_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':meal_id', $meal_id);
        $statement->execute();
        $meals = $statement->fetch();
        $statement->closeCursor();
        $meal_name = $meals['mealname'];
        return $meal_name;
    }

    function delete_meal($meal_id) {
        global $db;
        $query = 'DELETE FROM meals WHERE mealID = :meal_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':meal_id', $meal_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_meal($meal_name) {
        global $db;
        $query = 'INSERT INTO meals (mealname) VALUES (:mealName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':mealName', $meal_name);
        $statement->execute();
        $meals = $statement->fetchAll();
        $statement->closeCursor();
    }