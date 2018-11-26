<?php function draw_story($story){ ?>


    <div class="story bg-white">
        <header>
        <?php
            echo '<h1>' . $story['title'] . '</h1>';
            echo '<p>' . $story['text'] . '</p>';
        ?>
        </header>

        <hr />

        <footer> 
        <?php 
            echo '<p>' . $story['username'] . " " . $story['published'] . '</p>';
        ?>
        </footer>
                    
    </div>

<?php } ?>