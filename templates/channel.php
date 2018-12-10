<?php
include_once('../templates/story.php');

function drawChannel($title, $stories)
{
    /**
     * Draws a channel page.
     */
    ?>
    <div id="channel">

        <section class="container bg-white">

            <header>
                <h2><?= $title ?><h2>
            </header>

            <hr/>

            <a class="button secondary" href="#">
                New story
            </a>

            <button class="button secondary">Order by date</button> 

        </section>

        <div>
            <?php
            foreach ($stories as $story)
                drawStory($story);
            ?>
        </div>
    
    </div>

<?php 
}

/**
 * draws a channel card.
 */
function drawChannelCard($channel)
{
    $title = $channel['title'];
    $stories = getChannelStories($channel['channelId']);
    $nrStories = count($stories);

    ?>
        <a href="channel.php?title=<?= $channel['title'] ?>">
                        <div class="channel-card">
                            <div class="title">
                                <?= $channel['title'] ?>
                            </div>
                            <div class="stories-number">
                                <?php
                                if ($nrStories > 1) {
                                    echo $nrStories . ' stories';
                                } else {
                                    echo $nrStories . ' story';
                                } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
    <?php 
}

/**
 * Draws multiple channels cards.
 */
function drawChannelCards($channels) {
    if (count($channels) == 0) {
        ?>
            <div class="container bg-white">
                No channels.
            </div>
        <?php

        } else {
            foreach ($channels as $channel) {
                drawChannelCard($channel);
            }
        } 
}


/**
 * Draws the channels page.
 */
function drawChannelsPage($createdChannels, $subscribedChannels){ ?>
    <section id="channels">

        <div id="created-channels" csrf="<?= $_SESSION['csrf'] ?>">
            <section>
                <header class="container section-header">
                    Created
                    <button class="button primary" csrf="<?= $_SESSION['csrf'] ?>">New channel</button>
                    <div class="clearfix"></div>
                </header>

                <?php drawChannelCards($createdChannels); ?>
            </section>
        </div>

        <div id="subscribed-channels">
            <section>
                <header class="container section-header">
                    Subscribed
                </header>

                <?php drawChannelCards($subscribedChannels); ?> 
            </section>
        </div>

    </section>
        
<?php } ?>