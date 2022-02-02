<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/recipes.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/statistics.js" defer></script>
    <title>RECIPES</title>
</head>

<body>
<div class="base-container">
    <nav>
        <div class="logo2">
            <img src="/public/img/logo.svg">
        </div>
        <ul>
            <li>
                <i class="fas fa-home"></i>
                <a href="first.php" class="button">home</a>
            </li>
            <li>
                <i class="fas fa-address-card"></i>
                <a href="#" class="button">profile</a>
            </li>
            <li>
                <i class="fas fa-heart"></i>
                <a href="#" class="button">favorites</a>
            </li>
            <li>
                <i class="fas fa-utensils"></i>
                <a href="#" class="button">dishes</a>
            </li>
            <li>
                <i class="fas fa-cog"></i>
                <a href="#" class="button">settings</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                    <input placeholder="search recipe">
            </div>
            <div class="add-recipe">
                <i class="fas fa-plus"></i>
                Add recipe
            </div>
        </header>
        <section class="recipes">
            <?php foreach($recipes as $recipe): ?>
            <div id="<?= $recipe->getId(); ?>">
                <img src="/public/uploads/<?= $recipe->getImage() ?>">
                <div>
                    <div>
                        <h2><?= $recipe->getTitle() ?></h2>
                        <p><?= $recipe->getDescription() ?></p>
                        <div class="social-section">
                            <i class="fas fa-heart"> <?= $recipe->getLike(); ?></i>
                            <i class="fas fa-thumbs-down"> <?= $recipe->getDislike(); ?></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
</body>

<template id="recipe-template">
    <div id="">
        <img src="">
        <div>
            <div>
                <h2>title</h2>
                <p>description</p>
                <div class="social-section">
                    <i class="fas fa-heart"> 0</i>
                    <i class="fas fa-thumbs-down"> 0</i>
                </div>
            </div>
        </div>
    </div>
</template>
