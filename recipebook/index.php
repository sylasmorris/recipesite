<?php  
    require('models/database.php');
    require('models/recipe_db.php');
    require('models/meal_db.php');
    require('models/ingredient_db.php');

    //Fill variables with user input values

    $recipe_id = filter_input(INPUT_POST, 'recipeID', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_STRING);
    $meal_name = filter_input(INPUT_POST, 'mealname', FILTER_SANITIZE_STRING);
    $instr = filter_input(INPUT_POST, 'instr', FILTER_SANITIZE_STRING);
    $descr = filter_input(INPUT_POST, 'descr', FILTER_SANITIZE_STRING);

    $meal_id = filter_input(INPUT_POST, 'mealID', FILTER_VALIDATE_INT);
    if (!$meal_id){
        $meal_id = filter_input(INPUT_GET, 'mealID', FILTER_VALIDATE_INT);
    }

    $member = filter_input(INPUT_POST, 'member', FILTER_SANITIZE_STRING);

    $ing = $_POST['ing'] ?? null;
    $qua = $_POST['qua'] ?? null;

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_recipes';
        }
    }

    switch($action) {
        case "list_meals";
            $meals = get_meals();
            include('views/meal_list.php');
            break;

        case "add_meal";
            add_meal($meal_name);
            header("Location: .?action=list_meals");
            break;

        case "add_recipe":
            if($meal_id && $name && $member && $instr && $descr) {

                $recipe = add_recipe($meal_id, $name, $instr, $descr);
                for($i = 0; $i < $member; $i++){
                    add_ingredient($recipe, $qua[$i], $ing[$i]);
                }

                header("Location: .?mealID=0");

            } else {
                $error = "Error: Incorrect information entered. Please try again.";
                include('views/error.php');
                exit();
            }
            break;

        case "delete_meal":
            if($meal_id) {
                try {
                    delete_meal($meal_id);
                } catch(PDOException $e) {
                    $error = "This meal category is in use. Please remove all recipes and try again.";
                    include('views/error.php');
                    exit();
                }
                header("Location: .?action=list_meals");
            }
            break;

        case "delete_recipe":
            if($recipe_id){
                delete_recipe($recipe_id);
                header("Location: .?action=$meal_id");
            } else {
                $error = "This recipe does not exist";
                include('views/error.php');
            }
            break;

        case "view_recipe":
            if($recipe_id){
                $recipe_v = get_recipe($recipe_id);
                $ing_list = get_ingredients_by_recipe($recipe_id);
                include('views/recipe_detail.php');
            } else {
                $error = "This recipe does not exist";
                include('views/error.php');
            }
            break;


        default:
            $meal_name = get_meal_name($meal_id);
            $meals = get_meals();
            $recipes = get_recipes_by_meal($meal_id);
            include('views/recipe_list.php');
    }