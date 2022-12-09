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
                        <h2 class="tytul"><?= $recipe->getTitle() ?></h2>
                        <p class="opis"><?= $recipe->getDescription() ?>
<!--                            <span id = "dots">.......</span>-->
<!--                            <div id="more">-->
                                <p class="skl">SKLADNIKI:</p>
                                <div class = "lista">
                                    <p><?= $recipe->getSkladnik1() ?></p>
                                    <p><?= $recipe->getSkladnik2() ?></p>
                                    <p><?= $recipe->getSkladnik3() ?></p>
                                    <p><?= $recipe->getSkladnik4() ?></p>
                                    <p><?= $recipe->getSkladnik5() ?></p>
                                    <p><?= $recipe->getSkladnik6() ?></p>
                                    <p><?= $recipe->getSkladnik7() ?></p>
                                    <p><?= $recipe->getSkladnik8() ?></p>
                                    <p><?= $recipe->getSkladnik9() ?></p>
                                    <p><?= $recipe->getSkladnik10() ?></p>
                                </div>
<!--                            </div>-->
                        </p>
                        <div class="social-section">
                            <i class="fas fa-heart"> <?= $recipe->getLike(); ?></i>
                            <i class="fas fa-thumbs-down"> <?= $recipe->getDislike(); ?></i>
<!--                            <a href="/cook" class="buttonSHOW">SHOW</a>-->
                        </div>
<!--                        <button onclick="readmore()" id = "btn">Read more</button>-->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
<!--<script>-->
<!--    function readmore(){-->
<!--        var dots = document.getElementById("dots");-->
<!--        var moretext = document.getElementById('more');-->
<!--        var btn = document.getElementById('btn')-->
<!---->
<!--        if(dots.style.display === "none"){-->
<!--            dots.style.display = "inline";-->
<!--            btn.innerHTML = "Read more";-->
<!--            moretext.style.display = 'none';-->
<!--        }else{-->
<!--            dots.style.display = 'none';-->
<!--            btn.innerHTML = "Read less";-->
<!--            moretext.style.display = 'inline';-->
<!--        }-->
<!--    }-->
<!--</script>-->
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
