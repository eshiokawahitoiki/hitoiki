<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

<?php $colorMode = osc_get_preference('theme_color_mode', 'falgun');?>
<h2 class="render-title"><?php _e('Theme Style', 'falgun'); ?></h2>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php');?>" method="post" enctype="multipart/form-data" class="nocsrf">
    <input type="hidden" name="action_specific" value="theme_style" />
	<fieldset>
		<div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('RTL view', 'falgun'); ?></div>
                <div class="form-controls">
					<div class="form-label-checkbox">
						<input type="checkbox" name="rtl_view" value="1" <?php echo (osc_esc_html( osc_get_preference('rtl_view', 'falgun') ) == "1")? "checked": ""; ?>>
						<br>
						<div class="help-box"><?php _e('Right to left view.', 'falgun'); ?></div>
					</div>
				</div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Custom CSS', 'falgun'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;"name="custom_css"><?php echo osc_esc_html( osc_get_preference('custom_css', 'falgun') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('You can write your custom CSS and override the default CSS.', 'falgun'); ?></div>
                </div>
            </div>			
			<div class="form-actions">
				<input id="button" type="submit" value="<?php echo osc_esc_html(__('Save changes','falgun')); ?>" class="btn btn-submit">
			</div>
		</div>
	</fieldset>
</form>