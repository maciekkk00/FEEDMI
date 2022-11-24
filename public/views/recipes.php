<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/recipes.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8df2c6e6d4.js" crossorigin="anonymous"></script>
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
                <a href="/first" class="button">home</a>
            </li>
            <li>
                <i class="fas fa-utensils"></i>
                <a href="/cook" class="button">cook</a>
            </li>
            <li>
                <i class="fas fa-book"></i>
                <a href="/recipes" class="button">recipes</a>
            </li>
            <li>
                <i class="fas fa-blog"></i>
                <a href="/share" class="button">blog</a>
            </li>
            <li>
                <i class="fas fa-cog"></i>
                <a href="/settings" class="button">settings</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                    <input placeholder="search recipe">
            </div>
            <div class="add-recipe">
                <form class="add-button" action="addRecipe" method="post">
                    <button id="add">
                        <i class="fas fa-plus"></i>
                        Add recipe
                    </button>
                </form>
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
                            <a href="/cook" class="button">SHOW</a>
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
