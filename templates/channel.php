<?php
include_once '../templates/story.php';
include_once '../templates/formInput.php';

function drawChannel($title, $stories, $username)
{
    /**
     * Draws a channel page.
     */
    ?>
    <div id="channel">

        <section class="container header">

            <header>
                <h2><?=$title?><h2>
            </header>

            <hr/>

            <div style="display: flex; align-items: center;">
                <?php
                        if(userAlreadySubscribedChannel($username, $title) != 0)
                            $subscribed = "Unsubscribe";
                        else
                            $subscribed = "Subscribe";
                ?>
                <form id="subscribeForm" method="post" action = "../actions/action_subscribe.php" style="margin:0;">
                    <input type="hidden" name="username" value="<?=$username?>">
                    <input type="hidden" name="title" value="<?=$title?>">
                    <input type="hidden" name="subscribed" value="<?=$subscribed?>"> 
                    <input type="submit" class="button primary" value="<?=$subscribed?>">
                </form>

                <a class="button secondary" href="newStory.php?channel=<?=$title?>">                
                    New story
                </a>

                <button class="button terciary">Order by date</button>

            </div>
        </section>

        <div>
            <?php foreach ($stories as $story) {
                    drawStory($story);
            } ?>
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
        <a href="channel.php?title=<?=$channel['title']?>">

            <div class="channel-card">
                <div class="title">
                    <?=$channel['title']?>
                </div>

                <div class="stories-number">
                    <?php
                    if ($nrStories > 1) {
                        echo $nrStories . ' stories';
                    } else {
                        echo $nrStories . ' story';
                    }?>
                </div>
            </div>
            
        </a>
    <?php
}

/**
 * Draws multiple channels cards.
 */
function drawChannelCards($channels)
{
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
function drawChannelsPage($createdChannels, $subscribedChannels)
{?>
    <section id="channels">

        <div id="created-channels" csrf="<?=$_SESSION['csrf']?>">
            <section>
                <header class="section-header">
                    Created
                    <button class="button primary" csrf="<?=$_SESSION['csrf']?>">New channel</button>
                </header>

                <?php drawChannelCards($createdChannels);?>
            </section>
        </div>

        <div id="subscribed-channels">
            <section>
                <header class="section-header">
                    Subscribed
                </header>

                <?php drawChannelCards($subscribedChannels);?>
            </section>
        </div>

    </section>

<?php }?>