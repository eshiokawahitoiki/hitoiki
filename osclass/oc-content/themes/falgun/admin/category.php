<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

<style type="text/css" media="screen">
    .command { background-color: white; color: #2E2E2E; border: 1px solid black; padding: 8px; }
    .theme-files { min-width: 500px; }
</style>

<h2 class="render-title"><?php _e('Category Icon settings', 'falgun'); ?></h2>

<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/falgun/admin/category.php'); ?>" method="post" class="nocsrf">
    <input type="hidden" name="action_specific" value="icons" />
    <fieldset>
        <div class="form-row">
            <p>
                <?php _e('Choose custom font awesome icons for categories.', 'falgun'); ?>
                <br/>
                <?php _e('We use <a style="color: #018be3; text-decoration: none;" title="Visit Font Awesome site for help" target="_blank" href="https://fontawesome.com/icons?from=io">Font Awesome Icons.</a> Use whole font awesome icon code eg. <strong>fas fa-shopping-cart</strong>', 'falgun'); ?>
            </p>
        </div>
        <div class="form-horizontal">
        <?php  $icons = unserialize(osc_get_preference('icons', 'falgun')); while ( osc_has_categories() ) {?>

            <div class="form-row">
                <div class="form-label"><?php echo osc_esc_html(osc_category_name()) ?></div>
                <div class="form-controls"><input type="text" class="xlarge" name="icons[<?php echo osc_category_id()?>]" value="<?php echo osc_esc_html($icons[osc_category_id()])?>"></div>
            </div>
        <?php }?>    
        </div>
    </fieldset>
    <fieldset>
        <div class="form-actions">
            <input type="submit" value="<?php _e('Save changes', 'falgun'); ?>" class="btn btn-submit">
        </div>
    </fieldset>
</form>
