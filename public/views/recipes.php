<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/recipes.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
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
                <form>
                    <input placeholder="search recipe">
                </form>
            </div>
            <div class="add-recipe">
                <i class="fas fa-plus"></i>
                Add recipe
            </div>
        </header>
        <section class="recipes">
            <div id="recipe-1">
                <img src="/public/img/kurczak.png">
                <div>
                    <div>
                        <h2>STUFFED GOOSE</h2>
                        <p>An effective and tasty dish that will impress your guests?
                            Try this recipe and surprise your guests with a tasty surprise!</p>
                    </div>
                </div>
            </div>
            <div id="recipe-2">
                <img src="/public/img/ryz.png">
                <div>
                    <div>
                        <h2>RICE WITH MUSHROOMS</h2>
                        <p>An idea for an uncomplicated, one-pot dish - delicate arborio rice with fried mushrooms and garlic.</p>
                    </div>
                </div>
            </div>
            <div id="recipe-3">
                <img src="/public/img/dzik.png">
                <div>
                    <div>
                        <h2>WILD BOAR STEAK</h2>
                        <p>Aromatic wild boar steak with refreshing mint? This is the perfect combination that will delight all game lovers!</p>
                    </div>
                </div>
            </div>
            <?php foreach($recipes as $recipe): ?>
            <div id="recipe-4">
                <img src="/public/uploads/<?= $recipe->getImage() ?>">
                <div>
                    <div>
                        <h2><?= $recipe->getTitle() ?></h2>
                        <p><?= $recipe->getDescription() ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
</body>