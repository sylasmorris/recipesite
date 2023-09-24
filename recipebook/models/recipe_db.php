<?php

    function get_recipes_by_meal($meal_id){
        global $db;
        if ($meal_id) {
                $query = 'SELECT R.recipeID, R.recipename, T.mealname 
                FROM recipe R 
                LEFT JOIN meals T ON R.mealID = T.mealID 
                WHERE R.mealID = :mealID 
                ORDER BY R.recipeID';
        } else {
            $query = 'SELECT R.recipeID, R.recipename, T.mealname 
                FROM recipe R 
                LEFT JOIN meals T ON R.mealID = T.mealID 
                ORDER BY T.mealID';
        }
        $statement = $db->prepare($query);
        if ($meal_id) $statement->bindValue(':mealID', $meal_id);
        $statement->execute();
        $recipes = $statement->fetchAll();
        $statement->closeCursor();
        return $recipes;

    }

    function get_recipe($recipe_id) {
        global $db;
        $query = 'SELECT * FROM recipe WHERE recipeID = :recipe_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->execute();
        $recipes = $statement->fetch();
        $statement->closeCursor();
        return $recipes;
    }

    function delete_recipe($recipe_id) {
        global $db;
        $query = 'DELETE FROM recipe WHERE recipeID = :recipe_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_recipe($meal_id, $name, $inst, $desc) {
        global $db;
        $query = 'INSERT INTO recipe (recipename, mealID, instr, descr) VALUES (:n, :mealID, :i, :d)';
        $statement = $db->prepare($query);
        $statement->bindValue(':n', $name);
        $statement->bindValue(':mealID', $meal_id);
        $statement->bindValue(':d', $desc);
        $statement->bindValue(':i', $inst);
        $statement->execute();
        $statement->closeCursor();
        return $db->lastInsertId();
    }

    ?>