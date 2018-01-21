<?php

    if (isset($_POST['signup'])) {
        $screen_name = $_POST['screen_name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $error = '';

        if (empty($screen_name) or empty($password) or empty($email)) {
            $error = 'All fields are required';
        } else {
            $email = $getFromUser->checkInput($email);
            $screen_name = $getFromUser->checkInput($screen_name);
            $password = $getFromUser->checkInput($password);

            if (!filter_var($email)) {
                $error = 'Invalid email format';
            } elseif (strlen($screen_name) > 20) {
                $error = 'Name must be between 6-20 characters';
            } elseif (strlen($password) < 5) {
                $error = 'Password is too short';
            } else {
                if ($getFromUser->checkEmail($email) === true) {
                    $error = 'Email is already in use';
                } else {
                    $getFromUser->register($email, $screen_name, $password);
                    header('Location: home.php');
                }
            }
        }
    }

?>

<div class="signup-div">
    <form method="post">
        <fieldset class="fieldset-auto-width">
            <legend><h4>Sign Up</h4></legend>
            <div>
                <label for="name"></label>
                <input type="text" name="screen_name" placeholder="Full Name">
            </div>
            <br>
            <div>
                <label for="email"></label>
                <input type="email" name="email" placeholder="email address">
            </div>
            <br>
            <div>
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="password">
            </div>
            <br>
            <input type="submit" name="signup" value="Sign Up">
        </fieldset>
    </form>
    <?php
        if (isset($error)) {
            echo '<p style="color: red">'.$error.'</p>';
        }
    ?>
</div>


































