<?php
require "main/init.php";
$user_id = $_SESSION['user_id'];
$user = $getFromUser->userData($user_id);
?>

<ul>
    <li><a href="<?php echo $user->username;?>"><?php echo $user->username;?></a></li>
    <li><a href="includes/logout.php">Logout</a></li>
</ul>


































