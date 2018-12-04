<?php 
    include_once('../includes/session.php');
    include_once('../database/story.php');

    function draw_story($story) {

        $publishedDate = gmdate('F j, g:i a, Y', $story['published']);

        $linkToStory = "story.php?id=".$story['id'];

        // TODO: get story channel, link to channel

        // TODO: get story comments, link to story comments (story page)
        
        ?>
        <div class="story-card bg-white">
            <header>
                <a href=<?php echo $linkToStory ?> >
                    <h1>
                        <?php echo $story['title'] ?>
                    </h1>
                </a>
                <?php
                    echo '<small>'.$publishedDate.'</small>';
                ?>
            </header>

            <div class="story-body">
                <p><?php echo $story['text']; ?></p>
            </div>

            <hr />

            <footer> 
                <div class="story-footer-left">
                    <div class="vote-buttons">
                        <a class="button primary icon" href='../actions/action_vote.php?story_id=<?=$story['id']?>&vote=1&csrf=<?=$_SESSION['csrf']?>'>
                            <img src='icons/arrow-up.svg' alt="Vote up">
                        </a>
                        <span>
                            <?php echo get_story_likes($story['id']); ?>
                        </span>
                        <a class="button primary icon" href='../actions/action_vote.php?story_id=<?=$story['id']?>&vote=-1&csrf=<?=$_SESSION['csrf']?>'>
                            <img src='icons/arrow-down.svg' alt="Vote down">
                        </a>
                        <span>
                            <?php echo get_story_dislikes($story['id']); ?>
                        </span>
                    </div>
                    <div class="signature">
                        by <a href="#">@<?php echo $story['username']; ?> </a>
                        at channel <a href="#"><?php echo $story['channel']; ?> </a>
                    </div>
                </div>
                <div class="story-footer-right">
                    <a href="#">20 Comments </a>
                </div>
            </footer>
                        
        </div>

<?php } 

    function draw_story_page($story){ 

        $publishedDate = gmdate('F j, g:i a, Y', $story['published']);
        
        // TODO: get story comments
        $comments = []
        ?>

        <div id="story-page">
            <header class="container bg-white">
                <h1>
                    <?php echo $story['title'] ?>
                </h1>
            
                <?php
                    echo '<small>'.$publishedDate.'</small>';
                ?>

                <div id="story-description">
                    <p><?php echo $story['text']; ?></p>
                </div>

                <div class="signature">
                    by <a href="#">@<?php echo $story['username']; ?> </a>
                    at channel <a href="#"><?php echo $story['channel']; ?> </a>
                </div>
            </header>

            <section id="comments">
                <div id="comments-header" class="section-header">
                   
                  
                    <input id="comment-input" placeholder="Write a comment..." />
                    <button id="send-comment-button" class="button primary">Send</button>
  
                    <hr />

                    <button class="button secondary">Order</button>
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

<?php   } ?>