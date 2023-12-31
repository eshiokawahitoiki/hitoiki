<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

$field = usercf_get_field();
?>

<h1><?php _e('Edit a field', usercf_plugin()); ?></h1>
<form id="usercf_form" class="row nocsrf" method="POST" action="<?php echo osc_route_admin_url('usercf-field-edit'); ?>">
    <input type="hidden" name="edit" value="1">
    <input type="hidden" name="id" value="<?php echo $field['pk_i_id']; ?>">
    <div class="col-md-12 form-group">
        <label for="name"><?php _e('Name', usercf_plugin()); ?></label>
        <input class="form-control" id="name" name="name" placeholder="<?php _e('Enter a name for the field.', usercf_plugin()); ?>" type="text" required maxlength="60" value="<?php echo $field['s_name']; ?>">
    </div>

    <div class="col-md-6 form-group">
        <label for="type"><?php _e('Type', usercf_plugin()); ?></label>
        <select id="type" name="type">
            <?php
            $types = usercf_field_types();
            foreach($types as $type => $label) {
                if($field['s_type'] == $type) {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
                echo '<option value="'.$type.'"'.$selected.'>'.$label.'</option>';
            }
            ?>
        </select>
    </div>
    <div class="col-md-6 form-group">
        <div class="row">
            <div class="col-md-12 type-options">
                <label for="options"><?php _e('Options', usercf_plugin()); ?></label>
                <input class="form-control" id="options" name="options" placeholder="<?php _e('Enter possible field values.', usercf_plugin()); ?>" type="text" value="<?php echo $field['s_options']; ?>">
            </div>
            <div class="col-md-6 type-min">
                <label for="min"><?php _e('Min', usercf_plugin()); ?></label>
                <input class="form-control" id="min" name="min" placeholder="<?php _e('Enter min field value. Can be left empty.', usercf_plugin()); ?>" type="number" value="<?php echo $field['i_min']; ?>">
            </div>
            <div class="col-md-6 type-max">
                <label for="max"><?php _e('Max', usercf_plugin()); ?></label>
                <input class="form-control" id="max" name="max" placeholder="<?php _e('Enter possible field value. Can be left empty.', usercf_plugin()); ?>" type="number" value="<?php echo $field['i_max']; ?>">
            </div>
        </div>
    </div>

    <div class="col-md-4 form-group">
        <label><?php _e('Status', usercf_plugin()); ?></label>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-secondary<?php if($field['b_enabled']) { echo ' active'; } ?>">
                <input autocomplete="off" id="status-enable" name="status" type="radio" value="1"<?php if($field['b_enabled']) { echo ' checked'; } ?>><?php _e('Enabled', usercf_plugin()); ?>
            </label>
            <label class="btn btn-secondary<?php if(!$field['b_enabled']) { echo ' active'; } ?>">
                <input autocomplete="off" id="status-disable" name="status" type="radio" value="0"<?php if(!$field['b_enabled']) { echo ' checked'; } ?>><?php _e('Disabled', usercf_plugin()); ?>
            </label>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label><?php _e('Privacy', usercf_plugin()); ?></label>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-secondary<?php if($field['b_public']) { echo ' active'; } ?>">
                <input autocomplete="off" id="public-enable" name="public" type="radio" value="1"<?php if($field['b_public']) { echo ' checked'; } ?>><?php _e('Public', usercf_plugin()); ?>
            </label>
            <label class="btn btn-secondary<?php if(!$field['b_public']) { echo ' active'; } ?>">
                <input autocomplete="off" id="public-disable" name="public" type="radio" value="0"<?php if(!$field['b_public']) { echo ' checked'; } ?>><?php _e('Private', usercf_plugin()); ?>
            </label>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <label><?php _e('Required', usercf_plugin()); ?></label>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-secondary<?php if($field['b_required']) { echo ' active'; } ?>">
                <input autocomplete="off" id="required-enable" name="required" type="radio" value="1"<?php if($field['b_required']) { echo ' checked'; } ?>><?php _e('Yes', usercf_plugin()); ?>
            </label>
            <label class="btn btn-secondary<?php if(!$field['b_required']) { echo ' active'; } ?>">
                <input autocomplete="off" id="required-disable" name="required" type="radio" value="0"<?php if(!$field['b_required']) { echo ' checked'; } ?>><?php _e('No', usercf_plugin()); ?>
            </label>
        </div>
    </div>

    <div class="col-md-12 form-group">
        <label><?php _e('Position', usercf_plugin()); ?></label>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input autocomplete="off" id="position-reg" name="position" type="radio" value="REG"<?php if($field['e_position'] == 'REG') { echo ' checked'; } ?>><?php _e('Register form', usercf_plugin()); ?>
            </label>
            <label class="btn btn-secondary">
                <input autocomplete="off" id="position-dash" name="position" type="radio" value="DASH"<?php if($field['e_position'] == 'DASH') { echo ' checked'; } ?>><?php _e('Dashboard form', usercf_plugin()); ?>
            </label>
            <label class="btn btn-secondary">
                <input autocomplete="off" id="position-both" name="position" type="radio" value="BOTH"<?php if($field['e_position'] == 'BOTH') { echo ' checked'; } ?>><?php _e('Both', usercf_plugin()); ?>
            </label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="float-right">
            <button class="btn btn-primary" type="submit"><?php _e('Edit', usercf_plugin()); ?></button>
        </div>
    </div>
</form>

<?php echo usercf_footer(); ?>

<script>
    $(document).ready(function() {
        // Remove Osclass's (stupid) select UI.
        $('.select-box-trigger').remove();
        $('.select-box.form-control').removeClass('select-box');
        $('select').css('opacity', '1').addClass('form-control');
        $('.select-box').replaceWith(function() {
            return $('select', this);
        });

        // Hide options, min and max fields by default.
        $('.type-options, .type-min, .type-max').css('display', 'none');

        // Validate min and max fields.
        document.getElementById('min').onchange = minMaxValidate;
        document.getElementById('max').onkeyup = minMaxValidate;

        // Fill options, min and max if exist.
        // Fields that need options.
        <?php if(in_array($field['s_type'], usercf_field_types_options())) { ?>
            $('.type-options').css('display', 'block'); // Display options.
            $('.type-options').find('input').attr('required', 'required'); // Options required.
            $('.type-min, .type-max').css('display', 'none'); // Hide min & max.
        // Fields that need min/max.
        <?php } else if(in_array($field['s_type'], usercf_field_types_minmax())) { ?>
            $('.type-min, .type-max').css('display', 'block'); // Display min & max.
            <?php if($field['s_type'] == 'RANGE') { ?>
                $('.type-min, .type-max').find('input').attr('required', 'required.') // Min & max for range field.
            <?php } ?>
            $('.type-options').css('display', 'none'); // Hide options.
            $('.type-options').find('input').removeAttr('required'); // Options not required
        // Other fields.
        <?php } else { ?>
            $('.type-options, .type-min, .type-max').css('display', 'none').find('input').removeAttr('required'); // Hide all, nothing required.
        <?php } ?>

        // Show options, min and max fields according to field type.
        $('#type').change(function() {
            var value = $(this).find('option:selected').attr('value');
            switch(value) {
                // Fields that need options.
                <?php foreach(usercf_field_types_options() as $field) { ?>
                    case '<?php  echo $field; ?>':
                <?php } ?>
                    $('.type-options').css('display', 'block'); // Display options.
                    $('.type-options').find('input').attr('required', 'required'); // Options required.
                    $('.type-min, .type-max').css('display', 'none'); // Hide min & max.
                break;
                // Fields that need min/max.
                <?php foreach(usercf_field_types_minmax() as $field) { ?>
                    case '<?php  echo $field; ?>':
                <?php } ?>
                    $('.type-min, .type-max').css('display', 'block'); // Display min & max.
                    if(value == 'RANGE') {
                        $('.type-min, .type-max').find('input').attr('required', 'required.') // Min & max required if range field.
                    }
                    $('.type-options').css('display', 'none'); // Hide options.
                    $('.type-options').find('input').removeAttr('required'); // Options not required.
                break;
                // Other fields.
                default:
                    $('.type-options, .type-min, .type-max').css('display', 'none').find('input').removeAttr('required'); // Hide all, nothing required.
                break;
           }
        });
    });

    // Validate min and max fields.
    function minMaxValidate() {
        var min = document.getElementById('min')
        var max = document.getElementById('max');

        if(parseInt(min.value) >= parseInt(max.value)) {
            max.setCustomValidity('<?php _e('Max must be bigger than min.', usercf_plugin()); ?>');
        } else {
            max.setCustomValidity('');
        }
    }
</script>
