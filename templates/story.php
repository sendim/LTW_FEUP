<?php 
    include_once('../includes/session.php');
    include_once('../database/story.php');

    function draw_story($story) {

        $publishedDate = gmdate('F j, g:i a, Y', $story['published']);

        // TODO: get story channel, link to channel

        // TODO: get story comments, link to story comments (story page)
        
        ?>
        <div class="story-card bg-white">
            <header>
            <?php
                echo '<h1>' . $story['title'] . '</h1>';
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
                            <img src='images/arrow-up.svg' alt="Vote up">
                        </a>
                        <span>
                            <?php echo $story['likes']; ?>
                        </span>
                        <a class="button primary icon" href='../actions/action_vote.php?story_id=<?=$story['id']?>&vote=-1&csrf=<?=$_SESSION['csrf']?>'>
                            <img src='images/arrow-down.svg' alt="Vote down">
                        </a>
                        <span>
                            <?php
                                $dislikes = $story['dislikes'];
                                if ($dislikes != 0) 
                                    echo '-';
                                echo $dislikes; 
                            ?>
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

<?php } ?>