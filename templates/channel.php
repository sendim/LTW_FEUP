<?php
    include_once('../includes/session.php'); 
    include_once('../database/db_channel.php');
    include_once('../templates/story.php');

    function drawChannel($channelTitle) {
    /**
    * Draws a channel page.
    */ 
        $channelId = getChannelId($channelTitle);
        $stories = getChannelStories($channelId);
    ?>
    <div id="channel">

        <section class="container bg-white">

            <header>
                <h2><?=$channelTitle?><h2>
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

    function drawChannelsPage($username) {
    /**
    * Draws the channels page.
    */  
        $createdChannels = getUserCreatedChannels($username);
        $subscribedChannels = getUserSubscribedChannels($username);
    ?>
    <section id="channels">

        <div id="created-channels" csrf="<?=$_SESSION['csrf']?>">
            <section class="container">
                <header>
                    <h2>Created</h2>
                    <button class="button primary" csrf="<?=$_SESSION['csrf']?>">New channel</button>
                </header>

                <hr/>

                <?php
                    foreach($createdChannels as $createdChannel) {
                        $nrStories = sizeof(getChannelStories($createdChannel['channelId'])); 
                    ?>
                    <a href="channel.php?title=<?=$createdChannel['title']?>">
                        <div class="story-card bg-white">
                            <?php
                                echo $createdChannel['title'] . ' - ' . $nrStories;
                                if ($nrStories > 1)
                                    echo ' stories';
                                else
                                    echo 'story';
                            ?>
                        </div>
                    </a>
                <?php } ?>
            </section>
        </div>

        <div id="subscribed-channels">
            <section class="container">
                <header>
                    <h2>Subscribed</h2>
                </header>

                <hr/>

                <?php
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
                <?php } ?>   
            </section>
        </div>

    </section>
        
<?php } ?>