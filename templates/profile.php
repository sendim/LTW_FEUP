<?php 
    include_once('../includes/session.php');
    include_once('../database/user.php');
    include_once('../templates/story.php');
    include_once('../templates/comment.php');

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

                <?php echo '<p>' . $profile['description'] . '</p>'; ?>
            </section>

            <section id="stories">
                Stories
                <button>Order by date</button>
            </section>
            <section class="bg-white">
                <div>
                    <?php
                        $stories = get_user_stories($_SESSION['username']);
                        foreach($stories as $story) {
                            draw_story($story);
                        } ?>
                </div>
            </section>

            <section id ="comments">
                Comments
                <button>Order by date</button>
            </section>
            <section class="bg-white">
                <div>
                    <?php
                        $comments = get_user_comments($_SESSION['username']);
                        foreach($comments as $comment) {
                            draw_comment($comment);
                        } ?>
                </div>
            </section>
            
        </div>

<?php } ?>