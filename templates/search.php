<?php 
    include_once('../templates/story.php');
    include_once('../templates/profile.php');
    include_once('../templates/channel.php');

    function drawSearchFeed($profiles, $stories, $comments, $channels) { ?>
        <div id="feed">

            <section class="container bg-white">

                <header>
                    <h2>Search Results:</h2>
                </header>

                <hr/>

                <a class="button secondary" href="newStory.php">
                    New story
                </a>

                <button class="button secondary">Select channel</button>
                <button class="button secondary">Order</button> 

            </section>

            <div>
                <header>
                    <h2>Profiles:</h2>
                </header>
                <?php
                    foreach($profiles as $profile)
                        drawHeaderProfile($profile);
                ?>
                <header>
                    <h2>Stories:</h2>
                </header>
                <?php
                    foreach($stories as $story)
                        drawStory($story);
                ?>
                <header>
                    <h2>Comments:</h2>
                </header>
                <?php
                    foreach($comments as $comment) {
                        drawSimpleComment($comment);
                        ?>
                        </div> 
                    <?php } ?>
                        
                
                <header>
                    <h2>Channels:</h2>
                </header>
                
                <section id="channels">
                    <?php
                    foreach($channels as $channel)
                        drawChannelCard($channel);
                    ?>
                </section>
            </div>

        </div>
<?php } ?>
