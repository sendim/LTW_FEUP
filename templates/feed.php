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
                    <?php if($currChannel) { ?>
                        <option value="selectedChannel"><?=$currChannel?></option>
                    <?php } else { ?>
                        <option value="selectedChannel">Select channel</option>
                    <?php } foreach($channels as $channel) { 
                        if ($channel['title'] != $currChannel) { ?>
                            <option value="<?=$channel['title']?>"><?=$channel['title']?></option>
                    <?php }
                    } ?>
                </select>

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
        <script src="../js/getFeedRequest.js" defer></script>
<?php } ?>