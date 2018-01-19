<?php

if (isset($_POST['login']) && !empty($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) or !empty($password)) {
        $email = $getFromUser->checkInput($email);
        $password = $getFromUser->checkInput($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid format";
        } else {
            if ($getFromUser->login($email, $password) === false) {
                $error = "The email or password is incorrect";
            }
        }

    } else {
        $error = "Please enter username and password";
    }
}

?>

 <div class="login-div">
        <form method="post">
            <fieldset class="fieldset-auto-width">
                <legend><h4>Log In</h4></legend>
                <div>
                    <label for="email"></label>
                    <input type="email" name="email" placeholder="email address">
                </div>
                <br>
                <div>
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <br>
                <div>
                    <input type="checkbox" name="rememberme"> remember me
                </div>
                <br>
                <input type="submit" name="login" value="Log In">
            </fieldset>
        </form>
        <?php
            if (isset($error)) {
                echo '<p style="color: red">'.$error.'</p>';
            }
        ?>
    </div>


































