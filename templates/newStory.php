<?php

include_once '../templates/formInput.php';

/**
 * Draws new story page.
 */
function drawNewStory($channels, $selectedChannel)
{
    ?>

    <section id="new-story" class="container bg-white">
        <header>
            <h2>New story</h2>
        </header>

        <hr />

        <form method="post" action="../actions/action_addStory.php?csrf=<?=$_SESSION['csrf']?>" enctype="multipart/form-data">
                <?php drawTextInput("Title", "title", "required");?>

                <?php drawTextAreaInput("Description", "text", "required");?>

                <div class="form-input">
                    <label>Channel</label>
                    <select name="channel">
                        <?php if ($selectedChannel) {?>
                            <option value="<?=$selectedChannel?>"><?=$selectedChannel?></option>
                        <?php } else {
        foreach ($channels as $channel) {?>
                                <option value="<?=$channel['title']?>"><?=$channel['title']?></option>
                        <?php }
    }?>
                    </select>
                </div>

                <div class="form-input">
                    <label>Picture</label>
                    <input type='file' name='image' accept='image/jpeg'>
                </div>

                <button class="button primary" type="submit">
                  Create story
                </button>
        </form>

    </section>

<?php }?>