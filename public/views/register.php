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
            <form class="login reg" action="register" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="confirmedPassword" type="password" placeholder="confirm password">
                <input name="name" type="text" placeholder="name">
                <input name="surname" type="text" placeholder="surname">
                <input name="phone" type="text" placeholder="phone">
                <button type="submit" class="button-login">REGISTER</button>
            </form>
        </div>
    </div>
</body>