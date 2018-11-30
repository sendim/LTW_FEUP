<?php 
    include_once('../includes/session.php');
    include_once('../database/user.php');

    function draw_profile($profile) { ?> 
        <div id="feed">
            <section class="bg-white">
                <header>
                    <h2><?=$profile['name']?></h2>
                    <h3><?='@'.$profile['username']?></h3>
                </header> 
                
                <img src="images/star.svg" alt="Points">
                <?=$profile['points']?>

                <hr />

                <?php
                    $stories = get_user_stories($_SESSION['username']);
                    foreach($stories as $story) {
                        draw_story($story);
                    }
                    $comments = get_user_comments($_SESSION['username']);
                    foreach($comments as $comment) {
                        draw_comment($comment);
                    }
                ?>
            </section>
        </div>

<?php } ?>