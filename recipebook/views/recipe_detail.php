<?php include('views/header.php'); ?>

<section id="recipe">

    <header class = "recipe-info">
        <h1><?=$recipe_v['recipename']?></h1></br>
        <p class="descr" style="white-space: pre-line"><?=$recipe_v['descr']?></p></br>
        <div class="inglist">
        <?php foreach($ing_list as $ing) : ?>
            <p class="ing"><?=$ing['quantity']?> <?=$ing['ingredient']?></p></br>
        </div>
        <?php endforeach ?>
        <p class="instr" style="white-space: pre-line"><?=$recipe_v['instr']?></p>
    </header>
</section>

<form>
 <input type="button" value="Back to Recipe Book" onclick="history.back()">
</form>

<?php include('views/footer.php'); ?>