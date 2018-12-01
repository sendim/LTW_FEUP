<?php 
include_once('../templates/story.php');

function draw_feed($stories) { ?> 
    <div id="feed">
        <section class="bg-white">
            <header>
                <h2>Feed</h2>
            </header>

            <hr />

            <a class="button secondary" href="#">
                New story
            </a>

            <button class="button secondary">Select channel</button>
            <button class="button secondary">Order</button> 
        </section>

        <div>
            <?php
                foreach($stories as $story) {
                    draw_story($story);
                }
            ?>
        </div>
    </div>

<?php } ?>