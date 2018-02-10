<?php
    include "core/init.php";

    if (isset($_GET['hashtag']) && !empty($_GET['hashtag'])) {
        $hashtag = $getFromU->checkInput($_GET['hashtag']);
        $user_id = $_SESSION['user_id'];
        $user = $getFromU->userData($user_id);
        $tweets = $getFromT->getTweetsByHash($hashtag);

    } else {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style-complete.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">
        <div class="nav-container">
            <div class="nav">
                <div class="nav-left">
                    <ul>
                        <li><a href="<?=BASE_URL?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <?php if ($getFromU->loggedIn() === true):?>
                            <li><a href="<?=BASE_URL?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
                        <?php endif ?>
                    </ul>
                </div><!-- nav left ends-->
                <div class="nav-right">
                    <ul>
                        <li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
                            <div class="search-result">
                            </div>
                        </li>
                        <?php if ($getFromU->loggedIn() === true) {?>
                            <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?=BASE_URL.$user->profileImage?>"/></label>
                                <input type="checkbox" id="drop-wrap1">
                                <div class="drop-wrap">
                                    <div class="drop-inner">
                                        <ul>
                                            <li><a href="<?=BASE_URL.$user->username?>"><?=$user->username?></a></li>
                                            <li><a href="<?=BASE_URL?>settings/account">Settings</a></li>
                                            <li><a href="<?=BASE_URL?>includes/logout.php">Log out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
                        <?php } else {
                            echo '<li><a href="'.BASE_URL.'index.php">Have an account? Log in!</a></li>';
                        }?>
                    </ul>
                </div><!-- nav right ends-->

            </div><!-- nav ends -->
        </div><!-- nav container ends -->
    </div><!-- header wrapper end -->


    <!--#hash-header-->
    <div class="hash-header">
        <div class="hash-inner">
            <h1>#<?=$hashtag?></h1>
        </div>
    </div>
    <!--#hash-header end-->

    <!--hash-menu-->
    <div class="hash-menu">
        <div class="hash-menu-inner">
            <ul>
                <li><a href="<?=BASE_URL.'hashtag/'.$hashtag?>">Latest</a></li>
                <li><a href="<?=BASE_URL.'hashtag/'.$hashtag.'?f=users'?>">Accounts</a></li>
                <li><a href="<?=BASE_URL.'hashtag/'.$hashtag.'?f=photos'?>">Photos</a></li>
            </ul>
        </div>
    </div>
    <!--hash-menu-->
    <!---Inner wrapper-->

    <div class="in-wrapper">
        <div class="in-full-wrap">

            <div class="in-left">
                <div class="in-left-wrap">

                    <?php $getFromF->whoToFollow($user_id, $user_id) ?>

                    <?php $getFromT->trends() ?>

                </div>
                <!-- in left wrap-->
            </div>
            <!-- in left end-->

            <!-- TWEETS IMAGES  -->
            <!--  <div class="hash-img-wrapper">
                 <div class="hash-img-inner">
                     <div class="hash-img-flex">
                         <img src="TWEET-IMAGE"/>
                         <div class="hash-img-flex-footer">
                             <ul>
                                 <li><i class="fa fa-share" aria-hidden="true"></i></li>
                                 <li><i class="fa fa-retweet" aria-hidden="true"></i></li>
                                 <li><i class="fa fa-heart" aria-hidden="true"></i></li>
                             </ul>
                         </div>
                    </div>
                </div>
            </div>  -->
            <!-- TWEETS IMAGES -->

            <!--TWEETS ACCOUTS-->
            <!-- <div class="wrapper-following">
            <div class="wrap-follow-inner">

             <div class="follow-unfollow-box">
                <div class="follow-unfollow-inner">
                    <div class="follow-background">
                        <img src="PROFILE-COVER"/>
                    </div>
                    <div class="follow-person-button-img">
                        <div class="follow-person-img">
                             <img src="PROFILE-IMAGE"/>
                        </div>
                        <div class="follow-person-button">
                           PROFILE-BUTTON
                        </div>
                    </div>
                    <div class="follow-person-bio">
                        <div class="follow-person-name">
                            <a href="#">SCREEN-NAME</a>
                        </div>
                        <div class="follow-person-tname">
                            <a href="#">@USERNAME</a>
                        </div>
                        <div class="follow-person-dis">
                            PROFILE-BIO
                        </div>
                    </div>
                </div>
            </div>

            </div>
            </div> -->
            <!-- TWEETS ACCOUNTS -->

            <div class="in-center">
                <div class="in-center-wrap">
                    <?php
                    foreach ($tweets as $tweet) {
                        $likes = $getFromT->likes($user_id, $tweet->tweetID);
                        $retweet = $getFromT->checkRetweet($tweet->tweetID, $user_id);
                        $user = $getFromU->userData($tweet->retweetBy);
                        echo '
<div class="all-tweet">
    <div class="t-show-wrap">	
        <div class="t-show-inner">
                     '.(($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0) ? '
	        <div class="t-show-banner">
		        <div class="t-show-banner-inner">
			        <span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
		        </div>
	        </div>'
                                : '').'
                     
        '.((!empty($tweet->retweetMsg) && $tweet->tweetID === $retweet['tweetID'] or $tweet->retweetID > 0) ? '
    <div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
    <div class="t-show-head">
	<div class="t-show-img">
		<img src="'.BASE_URL.$user->profileImage.'"/>
	</div>
	<div class="t-s-head-content">
		<div class="t-h-c-name">
			<span><a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a></span>
			<span>@'.$user->username.'</span>
			<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
		</div>
		<div class="t-h-c-dis">
			'.$getFromT->getTweetLinks($tweet->retweetMsg).'
		</div>
	</div>
</div>
<div class="t-s-b-inner">
	<div class="t-s-b-inner-in">
		<div class="retweet-t-s-b-inner">
		
		    '.((!empty($tweet->tweetImage)) ? '
			<div class="retweet-t-s-b-inner-left">
				<img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'"/>	
			</div>
			' : '').'
			<div>
				<div class="t-h-c-name">
					<span><a href="'.BASE_URL.$tweet->username.'">'.$tweet->screenName.'</a></span>
					<span>@'.$tweet->username.'</span>
					<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
				</div>
				<div class="retweet-t-s-b-inner-right-text">		
					'.$getFromT->getTweetLinks($tweet->status).'
				</div>
			</div>
		</div>
	</div>
</div>
</div>' : '             

	<div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
		<div class="t-show-head">
			<div class="t-show-img">
				<img src="'.BASE_URL.$tweet->profileImage.'"/>
			</div>
			<div class="t-s-head-content">
				<div class="t-h-c-name">
					<span><a href="'.$tweet->username.'">'.$tweet->screenName.'</a></span>
					<span>@'.$tweet->username.'</span>
					<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
				</div>
				<div class="t-h-c-dis">
					'.$getFromT->getTweetLinks($tweet->status).'
				</div>
			</div>
		</div>'.

                                ((!empty($tweet->tweetImage)) ?
                                    '
		<div class="t-show-body">
		  <div class="t-s-b-inner">
		   <div class="t-s-b-inner-in">
		     <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'"/>
		   </div>
		  </div>
		</div>
		<!--tweet show body end-->
		' : '').'

	 </div>').'
	<div class="t-show-footer">
		<div class="t-s-f-right">
			<ul>
			
			'.(($getFromU->loggedIn() === true) ? '    
			
				<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>
				<li>'.(($tweet->tweetID === $retweet['retweetID'] OR $user_id === $retweet['retweetBy']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.$tweet->retweetCount.'</span></button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'</li>
				<li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'</li>
				'.(($tweet->tweetBy === $user_id) ? '   	
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<ul>
					  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
					</ul>
				</li>' : '').' 
				' : '<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>
                     <li><button><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a></button></li>
                     <li><button><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></button></li>
                     ').'
			</ul>
		</div>
	</div>
</div>
</div>
</div>';
                    }
                    ?>
                </div>
            </div>


        </div><!--in full wrap end-->
    </div><!-- in wrappper ends-->

</div><!-- ends wrapper -->
</body>
</html>
