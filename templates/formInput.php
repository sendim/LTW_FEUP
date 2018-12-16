<?php

/**
 * draws a form text input.
 */
function drawTextInput($label, $name, $otherParams = "")
{ ?>
    <div class="form-input">
        <label><?=$label?></label>
        <input type="text" name=<?=$name?> placeholder=<?=$label?> <?=$otherParams?>>
    </div>
<?php }

/**
 * Draws a form textarea input.
 */
function drawTextAreaInput($label, $name, $otherParams = "")
{ ?>
    <div class="form-input">
         <label><?=$label?></label>
        <textarea name=<?=$name?> placeholder=<?=$label?> <?=$otherParams?>></textarea>
    </div>
<?php } ?>