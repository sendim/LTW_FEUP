<?php

/**
 * draws a form text input.
 */
function drawTextInput($label, $name){ 
    ?>

    <div class="form-input">
        <label><?= $label ?></label>
        <input type="text" name=<?= $name ?> placeholder=<?= $label ?> >
    </div>

    <?php
}

/**
 * Draws a form textarea input.
 */
function drawTextAreaInput($label, $name){
    ?>

    <div class="form-input">
         <label><?= $label ?></label>
        <textarea name=<?= $name ?> placeholder=<?= $label ?>></textarea>
    </div>

    <?php
}


?>