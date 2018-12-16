<?php
include_once '../templates/tpl_story.php';
include_once '../templates/tpl_profile.php';
include_once '../templates/tpl_channel.php';

function drawSearchFeed($profiles, $stories, $comments, $channels, $input)
{?>
        <div id="feed">

            <section class="container header">
                <header>
                    <h2>Search results for <small>"<?php echo htmlspecialchars($input) ?>"</small></h2>
                </header>
            </section>

            <div>
                <header class="container section-header">
                    Profiles
                </header>
                <?php 
                    if (count($profiles) != 0) {
                        foreach ($profiles as $profile) {
                            drawHeaderProfile($profile);
                        }
                    } else { ?>
                        <div class="container bg-white">
                            No results found.
                        </div>
                <?php } ?>
                <header class="container section-header">
                    Stories
                </header>
                <?php 
                    if (count($stories) != 0) {
                        foreach ($stories as $story) {
                            drawStory($story);
                        }
                    } else { ?>
                        <div class="container bg-white">
                            No results found.
                        </div>
                <?php } ?>
                <header class="container section-header">
                    Comments
                </header>
                <?php 
                    if (count($comments) != 0) {
                        foreach ($comments as $comment) {
                            drawSimpleComment($comment); ?>
                        </div>
                <?php }
                    } else { ?>
                        <div class="container bg-white">
                            No results found.
                        </div>
                    <?php } ?>
                <header class="container section-header">
                    Channels
                </header>
                <?php 
                    if (count($channels) != 0) { ?>
                        <section id="channels">
                            <?php foreach ($channels as $channel) {
                                drawChannelCard($channel);
                            }
                    } else { ?>
                        <div class="container bg-white">
                            No results found.
                        </div>
                    <?php } ?>
            </section>
        </div>
    </div>
<?php }?>
