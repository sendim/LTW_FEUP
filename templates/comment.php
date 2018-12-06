<?php 
    include_once('../database/db_user.php');

    function drawComment($comment) {
    /**
     * Draws the comment section.
     */ 
        $username = getUserUsername($comment['userId']);
        $text = $comment['text'];
    ?>
        <div class="story bg-white">
            <hr/>
            
            <p>
                <a href="profile.php?username=<?=$username?>">@<?=$username?></a>
                <?= ' ' . $text ?>
            </p>
            
            <hr/>
        </div>
<?php } ?>