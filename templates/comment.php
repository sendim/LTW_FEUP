<?php function draw_comment($comment){ ?>

   <div class="story bg-white">
        <hr />

        <p><?='@' . $comment['username'] . ' ' . $comment['text']?></p>
    </div>

<?php } ?>