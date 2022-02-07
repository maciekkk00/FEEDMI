<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER PAGE</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="/public/img/logo.svg">
    </div>
    <div class="login-container">
        <form class="login logout" action="logout" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>

            <button class="button-login" type="submit">Log out</button>
            <a href="/first" class="button-login">BACK</a>
        </form>
    </div>
</div>
</body>