<?php

if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
    include 'core/init.php';
    $username = $getFromU->checkInput($_GET['username']);
    $profileId = $getFromU->userIdByUsername($username);
    $profileData = $getFromU->userData($profileId);
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);

    if (!$profileData) {
        header('Location: index.php');
    }

}

?>