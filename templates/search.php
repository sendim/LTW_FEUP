<?php 
    include_once('../templates/story.php');
    include_once('../templates/profile.php');
    include_once('../templates/channel.php');

    function drawSearchFeed($profiles, $stories, $comments, $channels, $input) { ?>
        <div id="feed">

            <section class="container bg-white">

                <header>
                    <h2>Search Results: <?php  echo $input ?> </h2>
                </header>
            </section>

            <div>
                <header>
                    <h2>Profiles:</h2>
                </header>
                <?php
                    if(count($profiles) != 0){
                        foreach($profiles as $profile)
                            drawHeaderProfile($profile);
                    }
                    else {
                        ?>
                        No results found.
                        <?php 
                    } ?> 
                <header>
                    <h2>Stories:</h2>
                </header>
                <?php
                    if(count($stories) != 0){
                        foreach($stories as $story)
                            drawStory($story); 
                    }
                    else {
                        ?>
                        No results found.
                        <?php 
                    } ?> 
                <header>
                    <h2>Comments:</h2>
                </header>
                <?php
                    if(count($comments) != 0){
                        foreach($comments as $comment) {
                            drawSimpleComment($comment);
                            ?>
                            </div> 
                        <?php 
                        } 
                    }
                    else {
                        ?>
                        No results found.
                        <?php 
                    } ?> 
                
                <header>
                    <h2>Channels:</h2>
                </header>
                <?php
                    if(count($channels) != 0){
                        ?>
                        <section id="channels">
                        <?php 
                            foreach($channels as $channel)
                                drawChannelCard($channel);
                            
                        }
                    else {
                        ?>
                        No results found.
                        <?php 
                    } ?> 
                </section>
            </div>

        </div>
<?php } ?>
