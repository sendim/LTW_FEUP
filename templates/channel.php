<?php
    include_once('../templates/story.php');

    function drawChannel($title, $stories) {
    /**
    * Draws a channel page.
    */ 
    ?>
    <div id="channel">

        <section class="container bg-white">

            <header>
                <h2><?=$title?><h2>
            </header>

            <hr/>

            <a class="button secondary" href="#">
                New story
            </a>

            <button class="button secondary">Order by date</button> 

        </section>

        <div>
            <?php
                foreach($stories as $story)
                    drawStory($story);
            ?>
        </div>
    
    </div>

<?php }

    /**
    * Draws the channels page.
    */ 
    function drawChannelsPage($createdChannels, $subscribedChannels) { 

    ?>
    <section id="channels">

        <div id="created-channels" csrf="<?=$_SESSION['csrf']?>">
            <section>
                <header class="container section-header">
                    Created
                    <button class="button primary" csrf="<?=$_SESSION['csrf']?>">New channel</button>
                </header>

                <?php
                    if (count($createdChannels) == 0){
                        ?>
                        <div class="container bg-white">
                            No created channels.
                        </div>
                        <?php
                    } else {
                    foreach($createdChannels as $createdChannel) {
                        $nrStories = sizeof(getChannelStories($createdChannel['channelId'])); 
                    ?>
                    <a href="channel.php?title=<?=$createdChannel['title']?>">
                        <div class="container bg-white">
                            <?php
                                echo $createdChannel['title'] . ' - ' . $nrStories;
                                if ($nrStories > 1)
                                    echo ' stories';
                                else
                                    echo 'story';
                            ?>
                        </div>
                    </a>
                <?php } } ?>
            </section>
        </div>

        <div id="subscribed-channels">
            <section>
                <header class="container section-header">
                    Subscribed
                </header>

                <?php
                if (count($subscribedChannels) == 0){
                    ?>
                    <div class="container bg-white">
                        No subscribed channels.
                    </div>
                    <?php
                } else {
                    foreach($subscribedChannels as $subscribedChannel) { 
                        $nrStories = sizeof(getChannelStories($subscribedChannel['channelId'])); 
                    ?>
                    <a href="channel.php?title=<?=$subscribedChannel['title']?>">
                        <div class="story-card bg-white">
                            <?php
                                echo $subscribedChannel['title'] . ' - ' . $nrStories;
                                if ($nrStories > 1)
                                    echo ' stories';
                                else
                                    echo 'story';
                            ?>
                        </div>
                    </a>
                <?php } } ?>   
            </section>
        </div>

    </section>
        
<?php } ?>