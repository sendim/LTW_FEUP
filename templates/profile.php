<?php 
    include_once('../includes/session.php');
    include_once('../database/user.php');
    include_once('../templates/story.php');
    include_once('../templates/comment.php');

    function draw_profile($profile) { 
        $comments = get_user_comments($_SESSION['username']);
        $stories = get_user_stories($_SESSION['username']);
        ?> 
        <div id="profile">

            <header id="profile-header" class="container bg-white">
                <header>
                    <div id="profile-header-user">
                        <h2><?=$profile['name']?></h2>
                        <small><?='@'.$profile['username']?></small>
                    </div>

                    <div id="profile-header-points">
                        <img src="images/star.svg" alt="Points">
                        <?=$profile['points']?>
                    </div>
    
                </header>

                <hr />
                
                <?php echo '<p>' . $profile['description'] . '</p>'; ?>
            </header>

            <section id="stories">
                <div id="stories-header" class="container section-header">
                    Stories
                    <button class="button secondary">Order by date</button>
                </div>

                <div id="stories-list">
                    <?php
                        if ($stories) {
                            foreach($stories as $story) {
                                draw_story($story);
                            }
                        } else { ?>
                            <div class="container bg-white"> No stories yet. </div>
                            <?php
                        } 
                    ?>
                </div>
            </section>

            <section id ="comments">
                <div id="comments-header" class="container section-header">
                    Comments
                    <button class="button secondary">Order by date</button>
                </div>

                <div id="comments-list">
                    <?php
                        if ($comments) {
                            foreach($comments as $comment) {
                                draw_comment($comment);
                            } 
                        } else {
                            ?>
                            <div class="container bg-white"> No comments yet. </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
            
        </div>

<?php } ?>