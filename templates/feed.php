<?php 
    include_once('../templates/story.php');

    function drawFeed($stories) { ?>
        <div id="feed">

            <section class="container bg-white">

                <header>
                    <h2>Feed</h2>
                </header>

                <hr/>

                <a class="button primary" href="newStory.php">
                    New story
                </a>

                <button class="button secondary">Select channel</button>

                <select class="button secondary">
                    <option value="date">Order by date</option>
                    <option value="alfabetic">Order by name</option>
                </select>

            </section>

            <div>
                <?php
                    foreach($stories as $story)
                        drawStory($story);
                ?>
            </div>
        </div>
<?php } ?>