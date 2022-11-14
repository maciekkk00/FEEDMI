<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg">
    </div>
    <div class="login-container">
        <form class="login" action="login" method="POST"> <!--w atrybucie akcja okreslamy sobie url strony, która ma zostac otwarta po wyslaniu tego formularza, (trzeba dodac ją do pliku index) -->
            <div class="messages">
                <?php if(isset($messages)) {           //sprawdzamy czy zmienna message jest ustawiona
                    foreach ($messages as $message) {  //wyswietlamy w petli
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com"><!--name=email, te atrybuty okreslaja nam pozniej pod jakim kluczem takie dane przyjda do naszego kontrolera  -->
            <input name="password" type="password" placeholder="password">
            <button type="submit" class="button-login">LOGIN</button> <!--tutaj okreslamy atrybut type=submit, aby w momencie wcisniecia przycisku dane z tego formularza zostaly wyslane za pomocą metosy POST i zostaly skierowane pod akcje login, ktora znajduje sie w SecurityController -->
            <a href="/register" class="button-login">REGISTER</a>
        </form>
    </div>
</div>
</body>