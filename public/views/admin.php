<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/first.css">
    <script src="https://kit.fontawesome.com/8df2c6e6d4.js" crossorigin="anonymous"></script>
    <title>FIRST</title>
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
                    <input placeholder="search">
                </form>
            </div>
            <div class="username">
                <p class="napis">ENJOY YOUR MEAL <i class="fas fa-smile"></i></p>
            </div>
        </header>
        <section>
            <a href="/cook" class="buttons button1">WHAT TO COOK</a>
            <a href="/recipes" class="buttons button2">RECIPES</a>
            <a href="/share" class="buttons button3">SHARE</a>
        </section>
    </main>
</div>
</body>


