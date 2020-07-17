<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

$fields = usercf_get_fields();
?>
<div class="usercf">
    <?php foreach($fields as $field) { ?>
        <?php UserCfFieldForm::field($field); ?>
    <?php } ?>
</div>
