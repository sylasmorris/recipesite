<?php include('views/header.php') ?>

<?php if($meals) { ?>
    <section id="list" class="list">
        <header class="list__row list__header">
            <h1>Meal Category List</h1>
</header>

<?php foreach ($meals as $meal) : ?>
<div class="list__row">
    <div class="list__item">
        <p class="bold"><?= $meal['mealname'] ?></p>
    </div>
    <div class="list__removeItem">
        <form action="." method="post">
            <input type="hidden" name="action" value="delete_meal">
            <input type="hidden" name="mealID" value="<?= $meal['mealID'] ?>">
            <button class="remove-button">❌</button>
        </form>
    </div>
</div>
<?php endforeach ?>
</section>

<?php } else { ?>
    <p>No meal categories have been added yet.
<?php } ?>

<section id="add" class="add">
    <h2>Add Meal</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_meal">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="mealname" maxlength="50"
            placeholder="Name..." autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".">View &amp; Add Recipes </a></p>
<?php include('views/footer.php') ?>