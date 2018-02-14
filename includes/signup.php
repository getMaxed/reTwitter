<?php
    if ($_SERVER['REQUEST_METHOD'] === "GET" && realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('Location: ../index.php');
    }
    include '../core/init.php';
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);

    if (isset($_GET['step']) === true && empty($_GET['step']) === false) {

        if (isset($_POST['next'])) {
            $username = $getFromU->checkInput($_POST['username']);

            if (!empty($username)) {
                if (strlen($username) > 20) {
                    $error = "Username must be between 6 and 20 characters";
                } elseif ($getFromU->checkUsername($username) === true) {
                    $error = "Username is already taken";
                } else {
                    $getFromU->update('users', $user_id, array('username' => $username));
                    header('Location: signup.php?step=2');
                }
            } else {
                $error = "Please enter your username";
            }
        }

        ?>
        <!doctype html>
        <html>
        <head>
            <title>reTwitter</title>
            <meta charset="UTF-8" />
            <link rel="stylesheet" href="assets/css/font/css/font-awesome.css"/>
            <link rel="stylesheet" href="../assets/css/style-complete.css"/>
        </head>
        <!--Helvetica Neue-->
        <body>
        <div class="wrapper">
            <!-- nav wrapper -->
            <div class="nav-wrapper">

                <div class="nav-container">
                    <div class="nav-second">
                        <ul>
                            <li><a href="#"<i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div><!-- nav second ends-->
                </div><!-- nav container ends -->

            </div><!-- nav wrapper end -->

            <!---Inner wrapper-->
            <div class="inner-wrapper">
                <!-- main container -->
                <div class="main-container">
                    <!-- step wrapper-->
                <?php if ($_GET['step'] == '1'):?>
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
                                        <li><?php if (isset($error)) {echo $error;}?></li>
                                    </ul>
                                </div>
                                <div>
                                    <input type="submit" name="next" value="Next"/>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ($_GET['step'] == '2'):?>
                     	<div class='lets-wrapper'>
                            <div class='step-letsgo'>
                                <h2>We're glad you're here, <?=$user->screenName?></h2>
                                <p>reTwitter is like Twitter, but better. Updating stream of the coolest, most important news, media, sports, TV, conversations and more - all for you.</p>
                                <br/>
                                <p>
                                    Tell us about all the stuff you love and we got you.
                                </p>
                                <span>
                                    <a href='../home.php' class='backButton'>Let's go!</a>
                                </span>
                            </div>
                        </div>
                <?php endif;?>

                </div><!-- main container end -->

            </div><!-- inner wrapper ends-->
        </div><!-- ends wrapper -->

        </body>
        </html>

        <?php
    }
?>