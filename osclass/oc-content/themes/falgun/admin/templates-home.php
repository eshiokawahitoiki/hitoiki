<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

<h2 class="render-title">
  <?php _e('Home page settings', 'falgun'); ?>
</h2>

<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php'); ?>" method="post" class="nocsrf">
  <input type="hidden" name="action_specific" value="templates_home" />
  <fieldset>
    <div class="form-horizontal">
      <div class="form-row">
        <div class="form-label">
          <?php _e('Show Banner', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" name="show_banner" value="1" <?php echo ( osc_esc_html( osc_get_preference('show_banner', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Post Job Heading', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="text" class="xlarge" name="post_job_heading" value="<?php echo osc_esc_html( osc_get_preference('post_job_heading', 'falgun') ); ?>" maxlength="30" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Post Job Description', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <textarea style="height: 50px; width: 500px;" name="post_job_description"><?php echo  (osc_get_preference('post_job_description', 'falgun')) ; ?></textarea>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-label">
          <?php _e('Browse Job Heading', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="text" class="xlarge" name="browse_job_heading" value="<?php echo osc_esc_html( osc_get_preference('browse_job_heading', 'falgun') ); ?>" maxlength="30" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Browse Job Description', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <textarea style="height: 50px; width: 500px;" name="browse_job_description"><?php echo  (osc_get_preference('browse_job_description', 'falgun')) ; ?></textarea>
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Search placeholder', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="text" class="xlarge" name="keyword_placeholder" value="<?php echo osc_esc_html( osc_get_preference('keyword_placeholder', 'falgun') ); ?>" maxlength="30" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Search country option', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" class="switch" name="show_search_country" value="1" <?php echo (osc_esc_html( osc_get_preference('show_search_country', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
	  
      <div class="form-row">
        <div class="form-label">
          <?php _e('Premium listings shown', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="number" min="1" max="50" class="xlarge" name="premium_listings_shown_home" value="<?php echo osc_esc_html( osc_get_preference('premium_listings_shown_home', 'falgun') ); ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Subcategories limit ', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="number" min="1" max="100" class="xlarge" name="sub_cat_limit" value="<?php echo osc_esc_html( osc_get_preference('sub_cat_limit', 'falgun') ); ?>">
        </div>
      </div>
	   <div class="form-row">
        <div class="form-label">
          <?php _e('Show popular', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" name="show_popular" value="1" <?php echo ( osc_esc_html( osc_get_preference('show_popular', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Popular searches', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" name="show_popular_searches" value="1" <?php echo ( osc_esc_html( osc_get_preference('show_popular_searches', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
	   <div class="form-row">
        <div class="form-label">
          <?php _e('Popular regions', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" name="show_popular_regions" value="1" <?php echo ( osc_esc_html( osc_get_preference('show_popular_regions', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
	        <div class="form-row">
        <div class="form-label">
          <?php _e('Popular cities', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <div class="form-label-checkbox">
            <input type="checkbox" name="show_popular_cities" value="1" <?php echo ( osc_esc_html( osc_get_preference('show_popular_cities', 'falgun') ) == "1")? "checked": ""; ?>>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-label">
          <?php _e('Popular searches limit', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="number" min="1" max="100" name="popular_searches_limit" value="<?php echo osc_esc_html( osc_get_preference('popular_searches_limit', 'falgun') ); ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-label">
          <?php _e('Popular regions limit', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="number" min="1" max="100" name="popular_regions_limit" value="<?php echo osc_esc_html( osc_get_preference('popular_regions_limit', 'falgun') ); ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-label">
          <?php _e('Popular cities limit', 'falgun'); ?>
        </div>
        <div class="form-controls">
          <input type="number" min="1" max="100" name="popular_cities_limit" value="<?php echo osc_esc_html( osc_get_preference('popular_cities_limit', 'falgun') ); ?>">
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-actions">
    <input type="submit" value="<?php echo osc_esc_html(__('Save changes', 'falgun')); ?>" class="btn btn-submit">
  </div>
</form>
