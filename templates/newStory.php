<?php

include_once '../templates/formInput.php';

/**
 * Draws new story page.
 */
function drawNewStory($channels)
{
    ?>

    <section id="new-story" class="container bg-white">
        <header>
            <h2>New story</h2>
        </header>

        <hr />

        <form method="post" action="../actions/action_addStory.php">
                <?php drawTextInput("Title", "title");?>

                <?php drawTextAreaInput("Description", "text");?>

                <div class="form-input">
                    <label>Channel</label>
                    <select name="channel">
                        <?php foreach ($channels as $channel) {?>
                            <option value="<?=$channel['title']?>"><?=$channel['title']?></option>
                        <?php }?>
                        <option value="">new channel ...</option>
                    </select>
                </div>

                <button class="button primary" type="submit">
                  Create story
            </button>
        </form>

    </section>

<?php }?>