<?php 
    include_once('../templates/story.php');

    function drawFeed($stories) { ?>
        <div id="feed">

            <section class="container bg-white">

                <header>
                    <h2>Feed</h2>
                </header>

                <hr/>

                <a class="button secondary" href="#">
                    New story
                </a>

                <button class="button secondary">Select channel</button>
                <button class="button secondary">Order</button> 

            </section>

            <div>
                <?php
                    foreach($stories as $story)
                        drawStory($story);
                ?>
            </div>

        </div>
<?php } ?>