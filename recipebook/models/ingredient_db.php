<?php

    function get_ingredients_by_recipe($recipe_id){
        global $db;
        if ($recipe_id) {
                $query = 'SELECT entryID, quantity, ingredient 
                FROM recipe_ingredients 
                WHERE recipeID = :recipeID
                ORDER BY ingredient';
        }
        $statement = $db->prepare($query);
        if ($recipe_id) $statement->bindValue(':recipeID', $recipe_id);
        $statement->execute();
        $ingredients = $statement->fetchAll();
        $statement->closeCursor();
        return $ingredients;

    }

    function delete_ingredient($entry_id) {
        global $db;
        $query = 'DELETE FROM ingredient WHERE entryID = :entry_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry_id', $entry_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_ingredient($recipe_id, $quantity, $ingredient) {
        global $db;
        $query = 'INSERT INTO recipe_ingredients (recipeID, quantity, ingredient) VALUES (:n, :q, :i)';
        $statement = $db->prepare($query);
        $statement->bindValue(':n', $recipe_id);
        $statement->bindValue(':q', $quantity);
        $statement->bindValue(':i', $ingredient);
        $statement->execute();
        $statement->closeCursor();
    }

    ?>