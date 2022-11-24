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
                <form>
                    <input placeholder="search">
                </form>
            </div>
            <div class="username">
                username <i class="fas fa-smile"></i>
            </div>
        </header>
        <section class="recipe-form">
            <h1>UPLOAD</h1>
            <form action="addRecipe" method="POST" ENCTYPE="multipart/form-data">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
                <input name="title" type="text" placeholder="title">
                <textarea name="description" rows="5" placeholder="description"></textarea>
                <input type="file" name="file">
                <button class ="add-recipe" type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>