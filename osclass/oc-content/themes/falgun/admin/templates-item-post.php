<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

<h2 class="render-title"><?php _e('Item post page settings', 'falgun'); ?></h2>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php'); ?>" method="post" class="nocsrf">
    <input type="hidden" name="action_specific" value="templates_item_post" />
    <fieldset>
        <div class="form-horizontal">
			<div class="form-row">
                <div class="form-label"><?php _e('Category multiple selects', 'falgun'); ?></div>
                <div class="form-controls">
					<div class="form-label-checkbox">
						<input type="checkbox" class="switch" name="category_multiple_selects" value="1" <?php echo (osc_esc_html( osc_get_preference('category_multiple_selects', 'falgun') ) == "1")? "checked": ""; ?>>
					</div>
				</div>
            </div>
		    <div class="form-row">
                <div class="form-label"><?php _e('Title min. length', 'falgun'); ?></div>
                <div class="form-controls"><input type="number" min="1" max="100" class="xlarge" name="title_minimum_length" value="<?php echo osc_esc_html( osc_get_preference('title_minimum_length', 'falgun') ); ?>"></div>
            </div>
		    <div class="form-row">
                <div class="form-label"><?php _e('Description min. length', 'falgun'); ?></div>
                <div class="form-controls"><input type="number" min="1" max="100" class="xlarge" name="description_minimum_length" value="<?php echo osc_esc_html( osc_get_preference('description_minimum_length', 'falgun') ); ?>"></div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Locations input as', 'falgun'); ?></div>
                <div class="form-controls">
                    <select name="defaultLocationShowAs">
                        <option value="dropdown" <?php if(falgun_default_location_show_as() == "dropdown"){ echo "selected=selected"; } ?>><?php echo osc_esc_html(__('Drop-down select','falgun')); ?></option>
                        <option value="autocomplete" <?php if(falgun_default_location_show_as() == "autocomplete"){ echo "selected=selected"; } ?>><?php echo osc_esc_html(__('Auto-complete text','falgun')); ?></option>
                    </select>
                </div>
            </div>
			<div class="form-row">
                <div class="form-label"><?php _e('Locations required', 'falgun'); ?></div>
                <div class="form-controls">
					<div class="form-label-checkbox">
						<input type="checkbox" name="locations_required" value="1" <?php echo (osc_esc_html( osc_get_preference('locations_required', 'falgun') ) == "1")? "checked": ""; ?>>
					</div>
				</div>
            </div>
		</div>
    </fieldset>

	<div class="form-actions">
		<input type="submit" value="<?php echo osc_esc_html(__('Save changes', 'falgun')); ?>" class="btn btn-submit">
	</div>
</form>