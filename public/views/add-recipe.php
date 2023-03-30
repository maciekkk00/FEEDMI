<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/recipes.css">
    <script src="https://kit.fontawesome.com/8df2c6e6d4.js" crossorigin="anonymous"></script>
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
                <form>
                    <input class="pasek" placeholder="search">
                </form>
            </div>
            <div class="username">
                <p class="napis">ENJOY YOUR MEAL <i class="fas fa-smile"></i></p>
            </div>
        </header>
        <section class="recipe-form">
            <h1>
                <div class="podajj">
                    ADD YOUR RECIPE
                </div>
            </h1>
            <form action="addRecipe" method="POST" ENCTYPE="multipart/form-data">  <!--akcja, ktora musimy utworzyc odpowiedni wpis w routingu (plik index.php)-->
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;                      //wiadomosci przekazane z kontrolera
                    }
                }
                ?>
                <input class="adek" name="title" type="text" placeholder="title">
                <textarea class="adek" name="description" rows="5" placeholder="description"></textarea>
                <textarea class="adek" name="skladnik1" rows="1" placeholder="skladnik1"></textarea>
                <textarea class="adek" name="skladnik2" rows="1" placeholder="skladnik2"></textarea>
                <textarea class="adek" name="skladnik3" rows="1" placeholder="skladnik3"></textarea>
                <textarea class="adek" name="skladnik4" rows="1" placeholder="skladnik4"></textarea>
                <textarea class="adek" name="skladnik5" rows="1" placeholder="skladnik5"></textarea>
                <textarea class="adek" name="skladnik6" rows="1" placeholder="skladnik6"></textarea>
                <textarea class="adek" name="skladnik7" rows="1" placeholder="skladnik7"></textarea>
                <textarea class="adek" name="skladnik8" rows="1" placeholder="skladnik8"></textarea>
                <textarea class="adek" name="skladnik9" rows="1" placeholder="skladnik9"></textarea>
                <textarea class="adek" name="skladnik10" rows="1" placeholder="skladnik10"></textarea>
                <input class="adek" type="file" name="file">
                <button class ="add-recipe" type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>