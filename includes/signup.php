<?php
include '../main/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromUser->userData($user_id);

if (isset($_GET['step']) === true && empty($_GET['step']) === false) {
    if (isset($_POST['next'])) {
        $username = $getFromUser->checkInput($_POST['username']);

        if (!empty($username)) {
            if (strlen($username) > 20) {
                $error = "Username must be between 6-20 characters";
            } elseif ($getFromUser->checkUsername($username) === true) {
                $error = "Username is already taken!";
            } else {
                $getFromUser->update('users', $user_id, array('username' => $username));
                header('Location: signup.php?step=2');
            }
        } else {
            $error = "Please enter your username to choose";
        }
    }


    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>twitter</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="../assets/css/font/css/font-awesome.css"/>
        <link rel="stylesheet" href="../assets/css/styles.css"/>
    </head>
    <body>
    <div class="wrapper">
        <!-- nav wrapper -->
        <div class="nav-wrapper">

            <div class="nav-container">
                <div class="nav-second">
                    <ul>
                        <li><a href="#"<i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>

        </div><

        <!---Inner wrapper-->
        <div class="inner-wrapper">
            <!-- main container -->
            <div class="main-container">
                <!-- step wrapper-->
            <?php if ($_GET['step'] == '1') {
                ?>
                <div class="step-wrapper">
                    <div class="step-container">
                        <form method="post">
                            <h2>Choose a Username</h2>
                            <h4>Don't worry, you can always change it later.</h4>
                            <div>
                                <input type="text" name="username" placeholder="Username"/>
                            </div>
                            <div>
                                <ul>
                                    <li><?php if (isset($error)){echo $error;} ?></li>
                                </ul>
                            </div>
                            <div>
                                <input type="submit" name="next" value="Next"/>
                            </div>
                        </form>
                    </div>
                </div>
                <?php }?>
                <?php if($_GET['step'] == '2') {?>
                 	<div class='lets-wrapper'>
		                <div class='step-letsgo'>
			                <h2>We're glad you're here, <?=$user->screen_name?></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis maximus sapien, vel tincidunt turpis.</p>
			                <br/>
			                <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit
			                </p>
			                <span>
				                <a href='../home.php' class='backButton'>Let's go!</a>
			                </span>
		                </div>
	                </div>
                <?php } ?>

            </div>

        </div>
    </div>

    </body>
    </html>


    <?php
}

?>

<!--header('Location: includes/signup.php?step=1');-->
