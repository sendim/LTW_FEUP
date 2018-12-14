<?php 
    include_once('../templates/story.php');

    function drawFeed($stories,$channels,$currChannel) { ?>
        <div id="feed">

            <section class="container header">

                <header>
                    <h2>Feed</h2>
                </header>

                <hr/>

                <a class="button primary" href="newStory.php">
                    New story
                </a>

                <select id="channel" class="button secondary">
                    <option value="none">Select channel</option>
                    <?php foreach($channels as $channel) { ?>
                            <option value="<?=$channel['title']?>"><?=$channel['title']?></option>
                        <?php
                    } ?>
                </select>

                <select id="order" class="button secondary">
                    <option value="none">Order by</option>
                    <option value="published_asc">Order by ascending date</option>
                    <option value="published_desc">Order by descending date</option>
                    <option value="title_asc">Order by ascending title</option>
                    <option value="title_desc">Order by descending title</option>
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