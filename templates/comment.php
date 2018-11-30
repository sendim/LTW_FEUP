<?php function draw_comment($comment){ ?>

    <div class="story bg-white">
        <hr />

        <footer> 
            <?php echo '<p>' . $comment['points']; ?>
        </footer>     
    </div>

<?php } ?>