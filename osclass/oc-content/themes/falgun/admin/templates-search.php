<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>
<?php $listings_per_row = osc_get_preference('listings_per_row', 'falgun');?>
<h2 class="render-title"><?php _e('Search page settings', 'falgun'); ?></h2>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php'); ?>" method="post" class="nocsrf">
    <input type="hidden" name="action_specific" value="templates_search" />
    <fieldset>
        <div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('Premium listings shown', 'falgun'); ?></div>
                <div class="form-controls"><input type="number" min="1" max="50" class="xlarge" name="premium_listings_shown" value="<?php echo osc_esc_html( osc_get_preference('premium_listings_shown', 'falgun') ); ?>"></div>
            </div>
		</div>
    </fieldset>

	<div class="form-actions">
		<input type="submit" value="<?php echo osc_esc_html(__('Save changes', 'falgun')); ?>" class="btn btn-submit">
	</div>
</form>