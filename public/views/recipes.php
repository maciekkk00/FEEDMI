<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/recipes.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8df2c6e6d4.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/search1.js" defer></script>
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
                <div>
                    <i class="fas fa-plus"></i>
                    <form class="butonik" action="addRecipe" method="post">
                        <button id="add">
                            add recipe
                        </button>
                    </form>
                </div>
            </li>
            <li>
                <i class="fas fa-book"></i>
                <a href="/recipes" class="button20">
                    <p class="recc">
                        recipes
                    </p>
                </a>
            </li>
            <li>
                <i class="fas fa-blog"></i>
                <a href="/blogs" class="button21">
                    <p class="blogg">
                        blog
                    </p>
                </a>
            </li>
<!--            <li>-->
<!--                <i class="fas fa-utensils"></i>-->
<!--                <a href="/cook" class="button">cook</a>-->
<!--            </li>-->
            <li>
                <i class="fas fa-cog"></i>
                <a href="/settings" class="button">settings</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                    <input placeholder="search recipe by title">
            </div>
            <div class="username">
                <p class="napis">ENJOY YOUR MEAL <i class="fas fa-smile"></i></p>
            </div>
        </header>
<!--        <div class="podajj2">-->
<!--            PODAJ SKLADNIKI-->
<!--        </div>-->
        <section class = "podaj_skladniki">
            <div class="search-bar2">
                <input placeholder="enter the ingredients you have">
            </div>
        </section>
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
                <h2 class="tytul">title</h2>
                <p class="opis">description
                    <p class="skl">SKLADNIKI:</p>
                    <div class = "lista">
                        <p id = "s1">sklad1</p>
                        <p id = "s2">sklad2</p>
                        <p id = "s3">sklad3</p>
                        <p id = "s4">sklad4</p>
                        <p id = "s5">sklad5</p>
                        <p id = "s6">sklad6</p>
                        <p id = "s7">sklad7</p>
                        <p id = "s8">sklad8</p>
                        <p id = "s9">sklad9</p>
                        <p id = "s10">sklad10</p>
                    </div>
                </p>
                <div class="social-section">
                    <i class="fas fa-heart"> 0</i>
                    <i class="fas fa-thumbs-down"> 0</i>
                </div>
            </div>
        </div>
    </div>
</template>
