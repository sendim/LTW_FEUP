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

            <button>Select channel</button>
            <button>Order</button> 
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