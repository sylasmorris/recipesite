<?php include('views/header.php'); ?>

<section id="list" class="list">

    <header class = "list__row list__header">
        <h1>RecipeBook </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_recipes">
            <select name="mealID" required>
                <option value="0">View All</option>
                <?php foreach ($meals as $meal) : ?>
                <?php if ($meal_id == $meal['mealID']){ ?>
                    <option value="<?= $meal['mealID'] ?>" selected>
                <?php } else { ?>
                    <option value="<?= $meal['mealID'] ?>">
                <?php } ?>
                    <?= $meal['mealname'] ?>
                    </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold"> Go </button>
        </form>
    </header>
    <?php if($recipes) { ?>
        <?php foreach ($recipes as $recipe) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $recipe['mealname'] ?></p>
                    <p><?= $recipe['recipename'] ?></p>
            </div>
            <div class="list__viewItem">
            <form action="." method="post">
                    <input type="hidden" name="action" value="view_recipe">
                    <input type="hidden" name="recipeID" value="<?=$recipe['recipeID'] ?>">
                    <button type="submit" class="view-button"> View </button>
                </form>
            </div>
            <div class="list__removeItem">
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_recipe">
                    <input type="hidden" name="recipeID" value="<?=$recipe['recipeID'] ?>">
                    <button class="remove-button"> ❌ </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } else { ?>
        <br>
        <?php if ($meal_id) { ?>
            <p> You haven't added any recipes for this type of meal yet. </p>
        <?php } else { ?>
            <p> You haven't added any recipes yet. </p>
            <?php } ?>
            <br>
            <?php } ?>
</section>

<section id="add" class="add">
    <h2>Add Recipe</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_recipe">
        <div class="add__inputs">
            <label>Meal:</label>
            <select class="input" name="mealID" required>
                <option value=""> Please select</option>
                <?php foreach ($meals as $meal) : ?>
                <option value="<?= $meal['mealID']; ?>">
                    <?= $meal['mealname']; ?>
                </option>
                <?php endforeach; ?>
            </select> <br>
            </div>
            <div class="add__inputs">
            <p>Name:</p>
            <input class="input" type='text' name="recipename" maxlength="100" placeholder="Name..." required><br>
            </div>
            <div class="add__inputs">
            <p>Description:</p>
            <textarea class="input" type='text' name="descr" cols="10" rows="10" placeholder="Describe your recipe here..." required></textarea><br>
            </div>
            <div class="add__inputs">
            <p>Instructions:</p>
            <textarea class="input" type='text' name="instr" cols="10" rows="10" placeholder="Write out your instructions here..." required></textarea><br>
            </div>
            <div class="add__inputs">
            <p>Number of ingredients:</p>
            <input class="input" type="number" id="member" name="member" value=1 min=1 max=20 required onkeyup=enforceMinMax(this)><br/>
            </div>
            <div id="container" class="add__inputs">
            </div>
        <div class = "add__addFields" id="otherbutton">
            <button class = "filldetails" id="filldetails" onclick="addFields()">Input Ingredients</button>
        </div>
        <div class="add__addItem" id = "thebutton">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_meals">View or Edit Meal Categories...</a></p>

<script type = "text/javascript">
function addFields(){
    var number = document.getElementById("member").value;
    var container = document.getElementById("container");
    while (container.hasChildNodes() && container.lastChild != document.getElementById("member")) {
        container.removeChild(container.lastChild);
    }

    document.getElementById("member").readOnly = true;

    for (i=0;i<number;i++){
        container.appendChild(document.createElement("br"));
        container.appendChild(document.createTextNode("Ingredient " + (i+1)));
        var input = document.createElement("input");
        input.type = "text";
        input.name = "ing[]";
        input.maxlength = 30;
        input.placeholder = "Ingredient..."
        input.required = true;
        container.appendChild(input);
        container.appendChild(document.createTextNode(" Quantity of Ingredient " + (i+1)));
        var input2 = document.createElement("input");
        input2.type = "text";
        input2.name = "qua[]";
        input2.required = true;
        input2.maxlength = 10;
        input2.placeholder = "Quantity..."
        container.appendChild(input2);
    }

    document.getElementById("thebutton").style.visibility = "visible";

}

function enforceMinMax(el) {
  if (el.value != "") {
    if (parseInt(el.value) < parseInt(el.min)) {
      el.value = el.min;
    }
    if (parseInt(el.value) > parseInt(el.max)) {
      el.value = el.max;
    }
  }
}
</script>

  

<?php include('views/footer.php'); ?>

