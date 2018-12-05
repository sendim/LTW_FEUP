<?php function drawComment($comment){
/**
 * Draws the comment section.
 */ ?>
    <div class="story bg-white">

        <hr/>
        <p><?='@' . $comment['username'] . ' ' . $comment['text']?></p>

    </div>
<?php } ?>