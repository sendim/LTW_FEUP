<?php 

include_once('../templates/formInput.php');

/**
 * Draws new story page.
 */
function drawNewStory () {

    ?>

    <section id="new-story" class="container bg-white">
        <header>
            <h2>New story</h2>
        </header>

        <hr />

        <form method="post" action="../actions/newStory.php">
                <?php drawTextInput("Title", "title"); ?>

                <?php drawTextAreaInput("Description", "text"); ?>

                <div class="form-input">
                    <label>Channel</label>
                    <!-- TODO: Poder selecionar canais ou criar outro -->
                </div>
  
                <button class="button primary" type="submit">
                    Create story
                </button>
            </form>

    </section>



    <?php

}

?>