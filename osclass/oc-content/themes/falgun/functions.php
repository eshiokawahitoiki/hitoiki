<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

/**

DEFINES

*/
if (osc_is_user_dashboard()){
    echo "This is user dashboard";
}
    define('FALGUN_THEME_VERSION', '101');
    if( (string)osc_get_preference('keyword_placeholder', 'falgun')=="" ) {
        Params::setParam('keyword_placeholder', __('ie. PHP Programmer', 'falgun') ) ;
    }
    osc_register_script('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.pack.js'), array('jquery'));
    osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('fancybox');

    osc_enqueue_style('font-awesome', osc_current_web_theme_url('css/font-awesome-5.3.1/css/all.css'));
    // used for date/dateinterval custom fields
    osc_enqueue_script('php-date');
    if(!OC_ADMIN) {
        osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
        osc_enqueue_style('falgun-fine-uploader-css', osc_current_web_theme_url('css/ajax-uploader.css'));
    }
    osc_enqueue_script('jquery-fineuploader');


    /**
** DEFAULT VALUES
**/
    if( !osc_get_preference('sub_cat_limit', 'falgun') ) {
        osc_set_preference('sub_cat_limit', 5, 'falgun');
    }
    if( !osc_get_preference('popular_regions_limit', 'falgun') ) {
        osc_set_preference('popular_regions_limit', 10, 'falgun');
    }   
    if( !osc_get_preference('popular_cities_limit', 'falgun') ) {
        osc_set_preference('popular_cities_limit', 10, 'falgun');
    }   
    if( !osc_get_preference('popular_searches_limit', 'falgun') ) {
        osc_set_preference('popular_searches_limit', 10, 'falgun');
    }
    
    if( !osc_get_preference('locations_input_as', 'falgun') ) {
        osc_set_preference('locations_input_as', 'text', 'falgun');
    }   
    if( !osc_get_preference('premium_listings_shown_home', 'falgun') ) {
        osc_set_preference('premium_listings_shown_home', 6, 'falgun');
    }
    if( !osc_get_preference('premium_listings_shown', 'falgun') ) {
        osc_set_preference('premium_listings_shown', 6, 'falgun');
    }
    if( !osc_get_preference('title_minimum_length', 'falgun') ) {
        osc_set_preference('title_minimum_length', 1, 'falgun');
    }   
    if( !osc_get_preference('description_minimum_length', 'falgun') ) {
        osc_set_preference('description_minimum_length', 3, 'falgun');
    }
    osc_reset_preferences();

/**

FUNCTIONS

*/
    // install options
    if( !function_exists('falgun_theme_install') ) {
        function falgun_theme_install() {
            osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'falgun');
            osc_set_preference('version', FALGUN_THEME_VERSION, 'falgun');
            osc_set_preference('footer_link', '1', 'falgun');
            osc_set_preference('donation', '0', 'falgun');
            osc_set_preference('defaultShowAs@all', 'list', 'falgun');
            osc_set_preference('defaultShowAs@search', 'list');
            osc_set_preference('show_banner', '1', 'falgun');
            osc_set_preference('defaultLocationShowAs', 'dropdown', 'falgun'); // dropdown / autocomplete
            osc_set_preference('show_popular', '1', 'falgun');
            osc_set_preference('show_popular_regions', '1', 'falgun');
            osc_set_preference('rtl_view', '0', 'falgun');
            osc_set_preference('show_popular_cities', '1', 'falgun');
            osc_set_preference('show_search_country', '1', 'falgun');
            osc_set_preference('show_popular_searches', '1', 'falgun');
            osc_set_preference('sub_cat_limit', 5, 'falgun');
            osc_set_preference('to_the_top', '1', 'falgun');
            $social = [ 'facebook' => '#', 'twitter' => '#', 'instagram' => '#', 'linkedin' => '#', 'google' => '#', 'youtube' => '#' ];
            osc_set_preference('social', serialize($social), 'falgun');
            osc_set_preference('post_job_heading', 'I AM RECRUITER!', 'falgun');
            osc_set_preference('browse_job_heading', 'I AM JOBSEEKER!', 'falgun');
            osc_reset_preferences();
        }
    }
    // update options
    if( !function_exists('falgun_theme_update') ) {
        function falgun_theme_update($current_version) {
            if($current_version==0) {
                falgun_theme_install();
            }
            osc_delete_preference('default_logo', 'falgun');

            $logo_prefence = osc_get_preference('logo', 'falgun');
            $logo_name     = 'falgun_logo';
            $temp_name     = WebThemes::newInstance()->getCurrentThemePath() . 'images/logo.png';
            if( file_exists( $temp_name ) && !$logo_prefence) {

                $img = ImageResizer::fromFile($temp_name);
                $ext = $img->getExt();
                $logo_name .= '.'.$ext;
                $img->saveToFile(osc_uploads_path().$logo_name);
                osc_set_preference('logo', $logo_name, 'falgun');
            }
            osc_set_preference('version', '101', 'falgun');

            if($current_version<101 || $current_version=='1.0.1') {
                // add preferences
                osc_set_preference('defaultLocationShowAs', 'dropdown', 'falgun');
                osc_set_preference('version', '101', 'falgun');
            }
            osc_set_preference('version', '101', 'falgun');
            osc_reset_preferences();
        }
    }
    if(!function_exists('check_install_falgun_theme')) {
        function check_install_falgun_theme() {
            $current_version = osc_get_preference('version', 'falgun');
            //check if current version is installed or need an update<
            if( $current_version=='' ) {
                falgun_theme_update(0);
            } else if($current_version < FALGUN_THEME_VERSION){
                falgun_theme_update($current_version);
            }
        }
    }

    function falgun_list_orders() {
        if (osc_price_enabled_at_items()) {
        return array(
                     __('Newly listed jobs', 'falgun')        => array('sOrder' => 'dt_pub_date', 'iOrderType' => 'desc')
                    ,__('Lower salary jobs first', 'falgun')   => array('sOrder' => 'i_price', 'iOrderType' => 'asc')
                    ,__('Higher salary jobs first', 'falgun')  => array('sOrder' => 'i_price', 'iOrderType' => 'desc')
                );
        }
        else {
        return array(
                     __('Newly listed jobs', 'falgun')        => array('sOrder' => 'dt_pub_date', 'iOrderType' => 'desc')
                );
        }
    }

    if(!function_exists('falgun_add_body_class_construct')) {
        function falgun_add_body_class_construct($classes){
            $falgunBodyClass = falgunBodyClass::newInstance();
            $classes = array_merge($classes, $falgunBodyClass->get());
            return $classes;
        }
    }
    if(!function_exists('falgun_body_class')) {
        function falgun_body_class($echo = true){
            /**
            * Print body classes.
            *
            * @param string $echo Optional parameter.
            * @return print string with all body classes concatenated
            */
            osc_add_filter('falgun_bodyClass','falgun_add_body_class_construct');
            $classes = osc_apply_filter('falgun_bodyClass', array());
            if($echo && count($classes)){
                echo 'class="'.implode(' ',$classes).'"';
            } else {
                return $classes;
            }
        }
    }
    if(!function_exists('falgun_add_body_class')) {
        function falgun_add_body_class($class){
            /**
            * Add new body class to body class array.
            *
            * @param string $class required parameter.
            */
            $falgunBodyClass = falgunBodyClass::newInstance();
            $falgunBodyClass->add($class);
        }
    }
    if(!function_exists('falgun_nofollow_construct')) {
        /**
        * Hook for header, meta tags robots nofollos
        */
        function falgun_nofollow_construct() {
            echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . PHP_EOL;
            echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . PHP_EOL;

        }
    }
    if( !function_exists('falgun_follow_construct') ) {
        /**
        * Hook for header, meta tags robots follow
        */
        function falgun_follow_construct() {
            echo '<meta name="robots" content="index, follow" />' . PHP_EOL;
            echo '<meta name="googlebot" content="index, follow" />' . PHP_EOL;

        }
    }
    /* logo */
    if( !function_exists('falgun_logo_url') ) {
        function falgun_logo_url() {
            $logo = osc_get_preference('logo','falgun');
            if( $logo ) {
                return osc_uploads_url($logo);
            }
            return false;
        }
    }
    if( !function_exists('logo_header') ) {
        function logo_header() {
             $logo = osc_get_preference('logo','falgun');
             $html = '<a href="'.osc_base_url().'"><img border="0" alt="' . osc_page_title() . '" src="' . falgun_logo_url() . '"></a>';
             if( $logo!='' && file_exists( osc_uploads_path() . $logo ) ) {
                return $html;
             } else {
                return '<a href="'.osc_base_url().'"><img border="0" height="50" width="158" alt="' . osc_page_title() . '" src = "' . osc_base_url().'oc-content/themes/falgun/images/logo.png' . '" ></a>';
            }
        }
    }

    /* homeimage */
    if( !function_exists('falgun_homeimage_url') ) {
        function falgun_homeimage_url() {
            $logo = osc_get_preference('falgun_homeimage','falgun');
            if( $logo ) {
                return osc_uploads_url($logo);
            }
            return false;
        }
    }
    if( !function_exists('falgun_homeimage1_url') ) {
        function falgun_homeimage1_url() {
            $logo = osc_get_preference('falgun_homeimage1','falgun');
            if( $logo ) {
                return osc_uploads_url($logo);
            }
            return false;
        }
    }
    if( !function_exists('homepage_image') ) {
        function homepage_image() {
            $logo = osc_get_preference('falgun_homeimage','falgun');
            $html = '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . falgun_homeimage_url() . '">';
            if ( !EMPTY ( $logo ) ) {
                return $html ;
            } 
        }
    }
    if( !function_exists('homepage_image1') ) {
        function homepage_image1() {
            $logo = osc_get_preference('falgun_homeimage1','falgun');
            $html = '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . falgun_homeimage1_url() . '">';
            if ( !EMPTY ( $logo ) ) {
                return $html ;
            } 
        }
    }
   
    if( !function_exists('falgun_favicon_url') ) {
        function falgun_favicon_url() {
            $logo = osc_get_preference('favicon','falgun');
            if( $logo ) {
                return osc_uploads_url($logo);
            }
            else
            {
                return osc_current_web_theme_url('images/favicon.png'); 
            }
        }
    }
    
    if( !function_exists('falgun_draw_item') ) {
        function falgun_draw_item($class = false,$admin = false, $premium = false) {
            $filename = 'loop-single';
            if($premium){
                $filename .='-premium';
            }
            require WebThemes::newInstance()->getCurrentThemePath().$filename.'.php';
        }
    }
    if( !function_exists('falgun_show_as') ){
        function falgun_show_as(){

            $p_sShowAs    = Params::getParam('sShowAs');
            $aValidShowAsValues = array('list', 'gallery');
            if (!in_array($p_sShowAs, $aValidShowAsValues)) {
                $p_sShowAs = falgun_default_show_as();
            }

            return $p_sShowAs;
        }
    }
    if( !function_exists('falgun_default_direction') ){
        function falgun_default_direction(){
            return getPreference('rtl_view','falgun');
        }
    }
    if( !function_exists('falgun_default_show_as') ){
        function falgun_default_show_as(){
            return getPreference('defaultShowAs@all','falgun');
        }
    }
    if( !function_exists('falgun_default_show_as_home') ){
        function falgun_default_show_as_home(){
            return getPreference('defaultShowAs@home','falgun');
        }
    }
    if( !function_exists('falgun_default_location_show_as') ){
        function falgun_default_location_show_as(){
            return osc_get_preference('defaultLocationShowAs','falgun');
        }
    }
    if( !function_exists('falgun_draw_categories_list') ) {
        function falgun_draw_categories_list(){ ?>
        <?php if(!osc_is_home_page()){ echo '<div class="resp-wrapper">'; } ?>
 
<h1 class="title" id="categories-heading-one"><?php _e('Job Categories', 'falgun');?></h1>
<div class="row" id="categories-row">
<?php

    $total_categories   = osc_count_categories();
    $col1_max_cat       = ceil($total_categories/1);
    osc_goto_first_category();
    $catcount   =   0;
    $icons = unserialize(osc_get_preference('icons', 'falgun'));
    while ( osc_has_categories() ) {
        $_catid      = osc_category_id();
?>
<ul class="col-lg-3 col-md-6 grid_list">
  <li>
    <section class="listings">
     <h2><i class="<?php echo osc_esc_html($icons[$_catid])?:'fas fa-archive'?>"></i>
      <?php
            $_slug      = osc_category_slug();
            $_url       = osc_search_category_url();
            $_name      = osc_category_name();
            $_total_items = osc_category_total_items();
            if ( osc_count_subcategories() > 0 ) { ?>
      <?php } ?>
      <?php if($_total_items > 0) { ?>
      <a class="category <?php echo $_slug; ?>" href="<?php echo $_url; ?>"><?php echo $_name ;?></a> <span><?php echo $_total_items ; ?></span>
      <?php } else { ?>
      <a class="category <?php echo $_slug; ?>" href="<?php echo $_url; ?>"><?php echo $_name ; ?></a> <span><?php echo $_total_items ; ?></span>
      <?php } ?>
    </h2>
    <?php if ( osc_count_subcategories() > 0 ) { $m=1; ?>
    <ul>
      <?php while ( osc_has_subcategories() ) { if( $m<=(osc_get_preference('sub_cat_limit', 'falgun'))){?>
      <li>
        <?php if( osc_category_total_items() > 0 ) { ?>
        <a class="category sub-category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span>
        <?php } else { ?>
        <a class="category sub-category <?php echo osc_category_slug() ; ?>" href="#"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span>
        <?php } ?>
      </li>
      <?php } $m++; } if($m>(osc_get_preference('sub_cat_limit', 'falgun'))+1) {?>
    </ul>
    <li class="last"><a href="<?php echo $_url; ?>"><button type="submit" class="btn btn-md"><?php _e('See more listings...', 'falgun');?></button></a></li>
      <?php } ?>
    <?php } ?>
    </section>
  </li>
</ul>
<?php
        $catcount++;
        if($catcount%4==0)
        {
            echo '</div><div class="row" id="categories-row">';
        }
    }
 ?>
 </div>
 <?php //if(!osc_is_home_page()){ echo '</div>'; } ?>
<?php
        }
    }
    if( !function_exists('falgun_search_number') ) {
        /**
          *
          * @return array
          */
        function falgun_search_number() {
            $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
            $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
            if( $search_to > osc_search_total_items() ) {
                $search_to = osc_search_total_items();
            }

            return array(
                'from' => $search_from,
                'to'   => $search_to,
                'of'   => osc_search_total_items()
            );
        }
    }
    /*
     * Helpers used at view
     */
    if( !function_exists('falgun_item_title') ) {
        function falgun_item_title() {
            $title = osc_item_title();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('title') != "" ) {
                    $title_ = Session::newInstance()->_getForm('title');
                    if( @$title_[$locale['pk_c_code']] != "" ){
                        $title = $title_[$locale['pk_c_code']];
                    }
                }
            }
            return $title;
        }
    }
    if( !function_exists('falgun_item_description') ) {
        function falgun_item_description() {
            $description = osc_item_description();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('description') != "" ) {
                    $description_ = Session::newInstance()->_getForm('description');
                    if( @$description_[$locale['pk_c_code']] != "" ){
                        $description = $description_[$locale['pk_c_code']];
                    }
                }
            }
            return $description;
        }
    }
    if( !function_exists('related_listings') ) {
        function related_listings() {
            View::newInstance()->_exportVariableToView('items', array());

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addRegion(osc_item_region());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems      = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems > 0 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            return 0;
        }
    }

    if( !function_exists('osc_is_contact_page') ) {
        function osc_is_contact_page() {
            if( Rewrite::newInstance()->get_location() === 'contact' ) {
                return true;
            }

            return false;
        }
    }

    if( !function_exists('get_breadcrumb_lang') ) {
        function get_breadcrumb_lang() {
            $lang = array();
            $lang['item_add']               = __('Publish a listing', 'falgun');
            $lang['item_edit']              = __('Edit your listing', 'falgun');
            $lang['item_send_friend']       = __('Send to a friend', 'falgun');
            $lang['item_contact']           = __('Contact publisher', 'falgun');
            $lang['search']                 = __('Search results', 'falgun');
            $lang['search_pattern']         = __('Search results: %s', 'falgun');
            $lang['user_dashboard']         = __('Dashboard', 'falgun');
            $lang['user_dashboard_profile'] = __("%s's profile", 'falgun');
            $lang['user_account']           = __('Account', 'falgun');
            $lang['user_items']             = __('Listings', 'falgun');
            $lang['user_alerts']            = __('Alerts', 'falgun');
            $lang['user_profile']           = __('Update account', 'falgun');
            $lang['user_change_email']      = __('Change email', 'falgun');
            $lang['user_change_username']   = __('Change username', 'falgun');
            $lang['user_change_password']   = __('Change password', 'falgun');
            $lang['login']                  = __('Login', 'falgun');
            $lang['login_recover']          = __('Recover password', 'falgun');
            $lang['login_forgot']           = __('Change password', 'falgun');
            $lang['register']               = __('Create a new account', 'falgun');
            $lang['contact']                = __('Contact', 'falgun');
            return $lang;
        }
    }

    if(!function_exists('user_dashboard_redirect')) {
        function user_dashboard_redirect() {
            $page   = Params::getParam('page');
            $action = Params::getParam('action');
            if($page=='user' && $action=='dashboard') {
                if(ob_get_length()>0) {
                    ob_end_flush();
                }
                header("Location: ".osc_user_list_items_url(), TRUE,301);
            }
        }
        osc_add_hook('init', 'user_dashboard_redirect');
    }

    if( !function_exists('get_user_menu') ) {
        function get_user_menu() {
            $options   = array();
            $options[] = array(
                'name' => __('Public Profile'),
                 'url' => osc_user_public_profile_url(),
               'class' => 'opt_publicprofile'
            );
            $options[] = array(
                'name'  => __('Listings', 'falgun'),
                'url'   => osc_user_list_items_url(),
                'class' => 'opt_items'
            );
            $options[] = array(
                'name' => __('Alerts', 'falgun'),
                'url' => osc_user_alerts_url(),
                'class' => 'opt_alerts'
            );
            $options[] = array(
                'name'  => __('Account', 'falgun'),
                'url'   => osc_user_profile_url(),
                'class' => 'opt_account'
            );
            $options[] = array(
                'name'  => __('Change email', 'falgun'),
                'url'   => osc_change_user_email_url(),
                'class' => 'opt_change_email'
            );
            $options[] = array(
                'name'  => __('Change username', 'falgun'),
                'url'   => osc_change_user_username_url(),
                'class' => 'opt_change_username'
            );
            $options[] = array(
                'name'  => __('Change password', 'falgun'),
                'url'   => osc_change_user_password_url(),
                'class' => 'opt_change_password'
            );
            $options[] = array(
                'name'  => __('Delete account', 'falgun'),
                'url'   => '#',
                'class' => 'opt_delete_account'
            );

            return $options;
        }
    }

    if( !function_exists('delete_user_js') ) {
        function delete_user_js() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( ($location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items'))) || (Params::getParam('page') ==='custom' && Params::getParam('in_user_menu')==true ) ) {
                osc_enqueue_script('delete-user-js');
            }
        }
        osc_add_hook('header', 'delete_user_js', 1);
    }

    if( !function_exists('user_info_js') ) {
        function user_info_js() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            if( $location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items')) ) {
                $user = User::newInstance()->findByPrimaryKey( Session::newInstance()->_get('userId') );
                View::newInstance()->_exportVariableToView('user', $user);
                ?>
<script type="text/javascript">
    falgun.user = {};
    falgun.user.id = '<?php echo osc_user_id(); ?>';
    falgun.user.secret = '<?php echo osc_user_field("s_secret"); ?>';
</script>
            <?php }
        }
        osc_add_hook('header', 'user_info_js');
    }

    function theme_falgun_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/falgun/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'falgun');
                osc_reset_preferences();
            }
        }
        
        switch( Params::getParam('action_specific') ) {
            case('settings'):
                osc_set_preference('contact_numbr', Params::getParam('contact_numbr'), 'falgun');
                osc_set_preference('contact_email', Params::getParam('contact_email'), 'falgun');
                osc_set_preference('footer_message',  trim(Params::getParam('footer_message', false, false, false)), 'falgun');
                osc_set_preference('defaultShowAs@all', Params::getParam('defaultShowAs@all'), 'falgun');
                osc_set_preference('defaultShowAs@search', Params::getParam('defaultShowAs@all'));
                $to_the_top   =   Params::getParam('to_the_top', 'falgun');
                osc_set_preference('to_the_top', ($to_the_top ? '1' : '0'), 'falgun');
                osc_add_flash_ok_message(__('Theme settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php'));
            break;
            case('templates_home'):
                osc_set_preference('show_banner', ((Params::getParam('show_banner'))? '1' : '0'), 'falgun');
                osc_set_preference('post_job_heading', Params::getParam('post_job_heading'), 'falgun');
                osc_set_preference('post_job_description',  trim(Params::getParam('post_job_description', false, false, false)), 'falgun');

                osc_set_preference('browse_job_heading', Params::getParam('browse_job_heading'), 'falgun');
                osc_set_preference('browse_job_description',  trim(Params::getParam('browse_job_description', false, false, false)), 'falgun');

                osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'falgun');
                
                osc_set_preference('show_search_country', ((Params::getParam('show_search_country'))? '1' : '0'), 'falgun');
                osc_set_preference('premium_listings_shown_home', Params::getParam('premium_listings_shown_home'), 'falgun');
                osc_set_preference('sub_cat_limit', Params::getParam('sub_cat_limit'), 'falgun');
                osc_set_preference('show_popular', Params::getParam('show_popular'), 'falgun');
                osc_set_preference('show_popular_regions', Params::getParam('show_popular_regions'), 'falgun');
                osc_set_preference('show_popular_cities', Params::getParam('show_popular_cities'), 'falgun');
                osc_set_preference('show_popular_searches', Params::getParam('show_popular_searches'), 'falgun');
                osc_set_preference('popular_regions_limit', Params::getParam('popular_regions_limit'), 'falgun');
                osc_set_preference('popular_cities_limit', Params::getParam('popular_cities_limit'), 'falgun');
                osc_set_preference('popular_searches_limit', Params::getParam('popular_searches_limit'), 'falgun');

                osc_add_flash_ok_message(__('Templates settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#templates' ));            break;
            case('templates_search'):
                osc_set_preference('premium_listings_shown', Params::getParam('premium_listings_shown'), 'falgun');
                
                osc_add_flash_ok_message(__('Templates settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#templates' ));            break;
            case('templates_item_post'):
                $locations_required =   Params::getParam('locations_required', 'falgun');
                $category_multiple_selects  =   Params::getParam('category_multiple_selects', 'falgun');
                osc_set_preference('title_minimum_length', Params::getParam('title_minimum_length', 'falgun'), 'falgun');
                osc_set_preference('description_minimum_length', Params::getParam('description_minimum_length', 'falgun'), 'falgun');
                osc_set_preference('defaultLocationShowAs', Params::getParam('defaultLocationShowAs'), 'falgun');
                osc_set_preference('locations_required', ($locations_required ? '1' : '0'), 'falgun');
                osc_set_preference('category_multiple_selects', ($category_multiple_selects ? '1' : '0'), 'falgun');
                
                osc_add_flash_ok_message(__('Templates settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#templates' ));
            break;

            case('ads_mgmt'):
                osc_set_preference('header-728x90', trim(Params::getParam('header-728x90', false, false, false)), 'falgun');
                osc_set_preference('homepage-728x90', trim(Params::getParam('homepage-728x90', false, false, false)), 'falgun');
                osc_set_preference('sidebar-300x250', trim(Params::getParam('sidebar-300x250', false, false, false)), 'falgun');
                osc_set_preference('search-results-top-728x90', trim(Params::getParam('search-results-top-728x90', false, false, false)), 'falgun');
                osc_set_preference('search-results-middle-728x90', trim(Params::getParam('search-results-middle-728x90', false, false, false)), 'falgun');

                osc_add_flash_ok_message(__('Ads management updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#ads' ));
            break;
            case('icons'):
                $icons = Params::getParam('icons');
                osc_set_preference('icons', serialize($icons), 'falgun');

                osc_add_flash_ok_message(__('Category icons settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#category' ));
            break;
            case('theme_style'):    
                
                $rtl_view   =   Params::getParam('rtl_view', 'falgun');
                osc_set_preference('rtl_view', ($rtl_view ? '1' : '0'), 'falgun');
                osc_set_preference('custom_css', trim(Params::getParam('custom_css', false, false, false)), 'falgun');
                
                osc_add_flash_ok_message(__('Theme style settings updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/falgun/admin/settings.php#theme-style' ));
                
            break;
            case ('social'):
                $social = [
                    'facebook' => trim(Params::getParam('facebook'))?:'',
                    'twitter' => trim(Params::getParam('twitter'))?:'',
                    'instagram' => trim(Params::getParam('instagram'))?:'',
                    'linkedin' => trim(Params::getParam('linkedin'))?:'',
                    'google' => trim(Params::getParam('google'))?:'',
                    'youtube' => trim(Params::getParam('youtube'))?:''
                    ];

                osc_set_preference('social', serialize($social), 'falgun');
                osc_add_flash_ok_message(__('Social links updated correctly', 'falgun'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#social'));
            break;
            case('upload_favicon'):
                $package = Params::getFiles('favicon');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $ext = $img->getExt();
                    $logo_name     = 'favicon';
                    $logo_name    .= '.'.$ext;
                    $path = osc_uploads_path() . $logo_name ;
                    $img->saveToFile($path);

                    osc_set_preference('favicon', $logo_name, 'falgun');

                    osc_add_flash_ok_message(__('The favicon image has been uploaded correctly', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#favicon'));
            break;
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $ext = $img->getExt();
                    $logo_name     = 'logo';
                    $logo_name    .= '.'.$ext;
                    $path = osc_uploads_path() . $logo_name ;
                    $img->saveToFile($path);

                    osc_set_preference('logo', $logo_name, 'falgun');

                    osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#logo'));
            break;
        
            case('remove_favicon'):
                $logo = osc_get_preference('favicon','falgun');
                $path = osc_uploads_path() . $logo ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_delete_preference('favicon','falgun');
                    osc_reset_preferences();
                    osc_add_flash_ok_message(__('The favicon image has been removed', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#favicon'));
            break;

            case('remove'):
                $logo = osc_get_preference('logo','falgun');
                $path = osc_uploads_path() . $logo ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_delete_preference('logo','falgun');
                    osc_reset_preferences();
                    osc_add_flash_ok_message(__('The logo image has been removed', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#logo'));
            break;
            
            case('upload_homeimage'):
                $package = Params::getFiles('homeimage');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $ext = $img->getExt();
                    $logo_name     = 'falgun_homeimage';
                    $logo_name    .= '.'.$ext;
                    $path = osc_uploads_path() . $logo_name ;
                    $img->saveToFile($path);

                    osc_set_preference('falgun_homeimage', $logo_name, 'falgun');

                    osc_add_flash_ok_message(__('The banner image has been uploaded correctly', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#banner'));
            break;  
            case('remove_homeimage'):
                $logo = osc_get_preference('falgun_homeimage','falgun');
                $path = osc_uploads_path() . $logo ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_delete_preference('falgun_homeimage','falgun');
                    osc_reset_preferences();
                    osc_add_flash_ok_message(__('The banner image has been removed', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#banner'));
            break;  

            case('upload_homeimage1'):
                $package = Params::getFiles('homeimage1');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $ext = $img->getExt();
                    $logo_name     = 'falgun_homeimage1';
                    $logo_name    .= '.'.$ext;
                    $path = osc_uploads_path() . $logo_name ;
                    $img->saveToFile($path);

                    osc_set_preference('falgun_homeimage1', $logo_name, 'falgun');

                    osc_add_flash_ok_message(__('The banner image has been uploaded correctly', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#banner'));
            break;  
            case('remove_homeimage1'):
                $logo = osc_get_preference('falgun_homeimage1','falgun');
                $path = osc_uploads_path() . $logo ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_delete_preference('falgun_homeimage1','falgun');
                    osc_reset_preferences();
                    osc_add_flash_ok_message(__('The banner image has been removed', 'falgun'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'falgun'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php#banner'));
            break;      
        }
    }

    function falgun_redirect_user_dashboard()
    {
        if( (Rewrite::newInstance()->get_location() === 'user') && (Rewrite::newInstance()->get_section() === 'dashboard') ) {
            header('Location: ' .osc_user_list_items_url());
            exit;
        }
    }

    function falgun_delete() {
        Preference::newInstance()->delete(array('s_section' => 'falgun'));
    }

    osc_add_hook('init', 'falgun_redirect_user_dashboard', 2);
    osc_add_hook('init_admin', 'theme_falgun_actions_admin');
    osc_add_hook('theme_delete_falgun', 'falgun_delete');
    osc_admin_menu_appearance(__('Falgun', 'falgun'), osc_admin_render_theme_url('oc-content/themes/falgun/admin/settings.php'), 'settings_falgun');
/**

TRIGGER FUNCTIONS

*/
check_install_falgun_theme();
if(osc_is_home_page()){
    osc_add_hook('inside-main','falgun_draw_categories_list');
}

if(osc_is_home_page() || osc_is_search_page()){
    falgun_add_body_class('has-searchbox');
}

function falgun_sidebar_category_search($catId = null)
{
    $aCategories = array();
    if($catId==null) {
        $aCategories[] = Category::newInstance()->findRootCategoriesEnabled();
    } else {
        // if parent category, only show parent categories
        $aCategories = Category::newInstance()->toRootTree($catId);
        end($aCategories);
        $cat = current($aCategories);
        // if is parent of some category
        $childCategories = Category::newInstance()->findSubcategoriesEnabled($cat['pk_i_id']);
        if(count($childCategories) > 0) {
            $aCategories[] = $childCategories;
        }
    }

    if(count($aCategories) == 0) {
        return "";
    }

    falgun_print_sidebar_category_search($aCategories, $catId);
}

function falgun_print_sidebar_category_search($aCategories, $current_category = null, $i = 0)
{
    $class = '';
    if(!isset($aCategories[$i])) {
        return null;
    }

    if($i===0) {
        $class = 'class="category"';
    }

    $c   = $aCategories[$i];
    $i++;
    if(!isset($c['pk_i_id'])) {
        echo '<ul '.$class.'>';
        if($i==1) {
            echo '<li><a href="'.osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))).'">'.__('All categories', 'falgun')."</a></li>";
        }
        foreach($c as $key => $value) {
    ?>
            <li>
                <a id="cat_<?php echo osc_esc_html($value['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $value['pk_i_id'], 'iPage'=>null))); ?>">
                <?php if(isset($current_category) && $current_category == $value['pk_i_id']){ echo '<strong>'.$value['s_name'].'</strong>'; echo '<span>('.$value['i_num_items'].')</span>'; }
                else{ echo $value['s_name']; echo '<span>('.$value['i_num_items'].')</span>'; } ?>
                </a>

            </li>
    <?php
        }
        if($i==1) {
        echo "</ul>";
        } else {
        echo "</ul>";
        }
    } else {
    ?>
    <ul <?php echo $class;?>>
        <?php if($i==1) { ?>
        <li><a href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))); ?>"><?php _e('All categories', 'falgun'); ?></a></li>
        <?php } ?>
            <li>
                <a id="cat_<?php echo osc_esc_html($c['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $c['pk_i_id'], 'iPage'=>null))); ?>">
                <?php if(isset($current_category) && $current_category == $c['pk_i_id']){ echo '<strong>'.$c['s_name'].'</strong>'; }
                      else{ echo $c['s_name']; } ?>
                </a>
                <?php falgun_print_sidebar_category_search($aCategories, $current_category, $i); ?>
            </li>
        <?php if($i==1) { ?>
        <?php } ?>
    </ul>
<?php
    }
}

function falgun_item_post_form_validate(){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#regionId, #cityId').removeAttr('disabled');
    });

    //form validate
    $('form[name=item]').validate({
        rules: {
            catId: {
                required: true,
                digits: true
            },
            'title[<?php echo osc_current_user_locale();?>]': {
                required:true,
                minlength:<?php echo falgun_title_minimum_length();?>
            },
            'description[<?php echo osc_current_user_locale();?>]': {
                minlength:<?php echo falgun_description_minimum_length();?>
            },
            price: {
                maxlength: 50
            },
            currency: "required",
            "photos[]": {
                accept: "png,gif,jpg,jpeg"
            },
            contactName: {
                required: true,
                minlength: 3,
                maxlength: 35
            },
            contactEmail: {
                required: true,
                email: true
            },
            countryId:{
                required: <?php echo falgun_locations_required(); ?>
            },
            region: {
                required: <?php echo falgun_locations_required(); ?>,
                minlength: 3,
                maxlength: 100
            },
            city: {
                required: <?php echo falgun_locations_required(); ?>,
                minlength: 3,
                maxlength: 100
            }
            <?php if(falgun_locations_input_as()=='select'){ ?>
            ,
            regionId: {
                required: <?php echo falgun_locations_required(); ?>
            },
            cityId: {
                required: <?php echo falgun_locations_required(); ?>
            }
            <?php } ?>
            
        },
        messages: {
            catId: {
            required: '<?php echo osc_esc_js(__("Choose one category", 'falgun')); ?>.'
            },
            'title[<?php echo osc_current_user_locale();?>]': {
                required: '<?php echo osc_esc_js(__("Title: this field is required", 'falgun')); ?>.',
                minlength: '<?php echo osc_esc_js(__("Title too short", 'falgun')); ?>.'
            },
            'description[<?php echo osc_current_user_locale();?>]': {
                minlength: '<?php echo osc_esc_js(__("Description too short", 'falgun')); ?>.'
            },
            price: {
                maxlength: '<?php echo osc_esc_js(__("Price: no more than 50 characters", 'falgun')); ?>.'
            },
            currency: '<?php echo osc_esc_js(__("Currency: make your selection", 'falgun')); ?>.',
            "photos[]": {
                accept: '<?php echo osc_esc_js(__("Photo: must be png,gif,jpg,jpeg", 'falgun')); ?>.'
            },
            contactName: {
                required: '<?php echo osc_esc_js(__("Name: this field is required", 'falgun')); ?>.',
                minlength: '<?php echo osc_esc_js(__("Name: enter at least 3 characters", 'falgun')); ?>.',
                maxlength: '<?php echo osc_esc_js(__("Name: no more than 35 characters", 'falgun')); ?>.'
            },
            contactEmail: {
                required: '<?php echo osc_esc_js(__("Email: this field is required", 'falgun')); ?>.',
                email: '<?php echo osc_esc_js(__("Invalid email address", 'falgun')); ?>.'
            },
            countryId: {
                required: '<?php echo osc_esc_js(__("Please select a country", 'falgun')); ?>.'
            },
            region: {
                required: '<?php echo osc_esc_js(__("Region: this field is required", 'falgun')); ?>.',
                minlength: '<?php echo osc_esc_js(__("Region: enter at least 3 characters", 'falgun')); ?>.',
                maxlength: '<?php echo osc_esc_js(__("Region: no more than 100 characters", 'falgun')); ?>.'
            },
            city: {
                required: '<?php echo osc_esc_js(__("City: this field is required", 'falgun')); ?>.',
                minlength: '<?php echo osc_esc_js(__("City: enter at least 3 characters", 'falgun')); ?>.',
                maxlength: '<?php echo osc_esc_js(__("City: no more than 100 characters", 'falgun')); ?>.'
            }
            <?php if(falgun_locations_input_as()=='select'){ ?>
            ,
            regionId: {
                required: '<?php echo osc_esc_js(__("Region: this field is required", 'falgun')); ?>.'
            },
            cityId: {
                required: '<?php echo osc_esc_js(__("City: this field is required", 'falgun')); ?>.'
            }
            <?php } ?>
        },
        errorLabelContainer: "#error_list",
        wrapper: "li",
        invalidHandler: function(form, validator) {
            $('html,body').animate({ scrollTop: $('h1').offset().top }, { duration: 250, easing: 'swing'});
        },
        submitHandler: function(form){
            $('button[type=submit], input[type=submit]').attr('disabled', 'disabled');
            setTimeout("$('button[type=submit], input[type=submit]').removeAttr('disabled')", 5000);
            form.submit();
        }
    });
</script>
<?php
}

if(osc_is_publish_page() || osc_is_edit_page()){
    osc_add_hook('footer', 'falgun_item_post_form_validate');
}


/**

CLASSES

*/
class falgunBodyClass
{
    /**
    * Custom Class for add, remove or get body classes.
    *
    * @param string $instance used for singleton.
    * @param array $class.
    */
    private static $instance;
    private $class;

    private function __construct()
    {
        $this->class = array();
    }

    public static function newInstance()
    {
        if (  !self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function add($class)
    {
        $this->class[] = $class;
    }
    public function get()
    {
        return $this->class;
    }
}

/**

HELPERS

*/
if( !function_exists('osc_uploads_url')) {
    function osc_uploads_url($item = '') {
        return osc_base_url().'oc-content/uploads/'.$item;
    }
}

function falgun_footer_msg(){
    if( osc_get_preference('footer_message', 'falgun') ) {
        return osc_get_preference('footer_message', 'falgun');
    }else{
        return false;
    }
}
function falgun_premium_listings_shown_home(){
    return osc_get_preference('premium_listings_shown_home', 'falgun');
}

function falgun_title_minimum_length(){
    return osc_get_preference('title_minimum_length', 'falgun');
}
function falgun_description_minimum_length(){
    return osc_get_preference('description_minimum_length', 'falgun');
}
function falgun_premium_listings_shown(){
    return osc_get_preference('premium_listings_shown', 'falgun');
}
function falgun_locations_input_as(){
    return osc_get_preference('locations_input_as', 'falgun');
}
function falgun_locations_required(){
    return (osc_get_preference('locations_required', 'falgun') == '1')? 'true': 'false';
}
function falgun_categories_select($name, $id, $label){
    $name = osc_esc_html($name);
    $id = osc_esc_html($id);
    $label = osc_esc_html($label);
    $categories = Category::newInstance()->toTreeAll();

    if(count($categories) > 0 ) {
            
        $html  = '<select name="'.$name.'" id="'.$id.'">';
        $html .= '<option value="">'.$label.'</option>';
        foreach($categories as $topcat) { 
            $html .= '<option class="top" value="'.osc_esc_html( $topcat['s_name']).'">'. $topcat['s_name'].'</option>';
            if(!empty($topcat['categories'])) {
                
                foreach($topcat['categories'] as $subcat) {
                    $html .= '<option value="'. osc_esc_html($subcat['s_name']).'">&nbsp;&nbsp;'. $subcat['s_name'].'</option>';
                }
            
            }
        } 
        $html .= '</select>';
    } 

    echo $html;
}
function falgun_countries_select($name, $id, $label, $value=NULL){
    $name = osc_esc_html($name);
    $id = osc_esc_html($id);
    $label = osc_esc_html($label);
    
    $aCountries = Country::newInstance()->listAll(); 
    if(count($aCountries) > 0 ) { 
        $html  = '<select name="'.$name.'" id="'.$id.'">';
        $html .= '<option value="">'.$label.'</option>';
        foreach($aCountries as $country) {
            if($value == $country['pk_c_code']) $selected = 'selected="selected"'; else $selected = '';
            $html .= '<option value="'. osc_esc_html($country['pk_c_code']).'" '.$selected.'>'. $country['s_name'].'</option>';
        } 
        $html .= '</select>';
    } 

    echo $html;
}
function falgun_regions_select($name, $id, $label, $value=NULL){
    $name = osc_esc_html($name);
    $id = osc_esc_html($id);
    $label = osc_esc_html($label);
    
    $aRegions = Region::newInstance()->listAll(); 
    if(count($aRegions) > 0 ) { 

        $html  = '<select name="'.$name.'" id="'.$id.'">';
        $html .= '<option value="" id="sRegionSelect">'.$label.'</option>';
        foreach($aRegions as $region) {
            if($value == $region['s_name']) $selected = 'selected="selected"'; else $selected = '';
            $html .= '<option value="'. osc_esc_html($region['s_name']).'" '.$selected.'>'. $region['s_name'].'</option>';
        } 
        $html .= '</select>';
    } 

    echo $html;
}
function falgun_cities_select($name, $id, $label, $value=NULL){
    $name = osc_esc_html($name);
    $id = osc_esc_html($id);
    $label = osc_esc_html($label);
    
    $html  = '<select name="'.$name.'" id="'.$id.'">';
    $html .= '<option value="" id="sCitySelect">'.$label.'</option>';
    if(osc_count_list_cities() > 0 ) {
        while(osc_has_list_cities() ) { 
            if($value == osc_list_city_name()) $selected = 'selected="selected"'; else $selected = '';
            $html .= '<option value="'. osc_esc_html(osc_list_city_name()).'" '.$selected.'>'. osc_list_city_name().'</option>';
        }
    }
    $html .= '</select>';

    echo $html;
}
function falgun_popular_regions($limit = 20){
    View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=') ) ;
    if(osc_count_list_regions() > 0 ) { 
        $array  =   array();
        while(osc_has_list_regions() ) {
            if( osc_list_region_items() > 0){
                $region_name            =   osc_list_region_name();
                $array[ $region_name ]  =   osc_list_region_items();
            }
        }
        arsort($array);
        return  array_slice($array, 0, $limit);
    }else{
        return false;
    }
}

function falgun_popular_cities($limit = 20){
    View::newInstance()->_exportVariableToView('list_cities', Search::newInstance()->listCities('%%%%', '>=') ) ;
    if(osc_count_list_cities() > 0 ) { 
        $array  =   array();
        while(osc_has_list_cities() ) {
            if( osc_list_city_items() > 0){ 
                $city_name  =   osc_list_city_name();
                $array[ $city_name ]    =   osc_list_city_items();
            }
        }
        arsort($array);
        return  array_slice($array, 0, $limit);
    }else{
        return false;
    }
}

class FalgunLatestSearches extends DAO
    {
        /**
         *
         * @var type
         */
        private static $instance;
        public static function newInstance()
        {
            if( !self::$instance instanceof self ) {
                self::$instance = new self;
            }
            return self::$instance;
        }
        /**
         *
         */
        function __construct()
        {
            parent::__construct();
            $this->setTableName('t_latest_searches');
            $array_fields = array(
                'd_date',
                's_search'
            );
            $this->setFields($array_fields);
        }
        /**
         * Get last searches, given a limit.
         *
         * @access public
         * @since unknown
         * @param int $limit
         * @return array
         */
        function falgun_popular_searches($limit = 20)
        {
            $this->dao->select('d_date, s_search, COUNT(s_search) as total');
            $this->dao->from($this->getTableName());
            $this->dao->groupBy('s_search');
            $this->dao->orderBy('d_date', 'DESC');
            $this->dao->limit($limit);
            $result = $this->dao->get();
            if( $result == false ) {
                return false;
            }
            return $result->result();
        }

        public function falgun_insert_search()
        {
            $search_word    =   Params::getParam('sPattern');
            if( isset($search_word) && !EMPTY($search_word) ){
                try {
                    $sql = sprintf('INSERT INTO %s (d_date, s_search) VALUES (now(), \'%s\')', $this->getTableName(), $search_word);
                    return $this->dao->query($sql);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

function falgun_insert_search_result()
{
    $insert_searches = new FalgunLatestSearches ;
    $insert_searches->falgun_insert_search() ; 
}
osc_add_hook( 'search', 'falgun_insert_search_result' ) ;

function falgun_show_popular_regions(){
    if(osc_get_preference('show_popular_regions', 'falgun') == 1){
        return true;
    }
    else{
        return false;
    }
}
function falgun_popular_regions_limit(){
    return osc_get_preference('popular_regions_limit', 'falgun');
}
function falgun_show_popular_cities(){
    if(osc_get_preference('show_popular_cities', 'falgun') == 1){
        return true;
    }
    else{
        return false;
    }
}
function falgun_popular_cities_limit(){
    return osc_get_preference('popular_cities_limit', 'falgun');
}
function falgun_show_popular_searches(){
    if(osc_get_preference('show_popular_searches', 'falgun') == 1){
        return true;
    }
    else{
        return false;
    }
}
function falgun_popular_searches_limit(){
    return osc_get_preference('popular_searches_limit', 'falgun');
}

function falgun_facebook_like_box(){
?>
<div class="fb-page" data-href="<?php echo osc_esc_html( osc_get_preference('facebook-url', 'falgun') ); ?>" data-width="<?php echo osc_esc_html( osc_get_preference('facebook-width', 'falgun') ); ?>" data-height="<?php echo osc_esc_html( osc_get_preference('facebook-height', 'falgun') ); ?>" data-hide-cover="<?php echo (osc_esc_html( osc_get_preference('facebook-hidecover', 'falgun')) == "1" ) ? "true":"false"; ?>" data-show-facepile="<?php echo (osc_esc_html( osc_get_preference('facebook-showface', 'falgun')) == "1" ) ? "true":"false"; ?>" data-show-posts="<?php echo (osc_esc_html( osc_get_preference('facebook-showpost', 'falgun')) == "1" ) ? "true":"false"; ?>"></div>
<?php
}
function falgun_footer_css(){
    $custom_css = trim(osc_get_preference('custom_css', 'falgun'));
    if( $custom_css != "" ){
        echo "<style>";
        echo $custom_css;
        echo "</style>";
    }
}
osc_add_hook('footer', 'falgun_footer_css');
function falgun_footer_js(){
    echo '<script type="text/javascript" src="'.osc_current_web_theme_js_url('main.js').'"></script>';
}
osc_add_hook('footer', 'falgun_footer_js');


//Falgun Attributes Plugin
function is_job_enabled(){
if(class_exists('ModelJobs'))
    return true;
else
    return false;
}

function job_get_Relation($id){
if( is_job_enabled() ){
    $detail = ModelJobs::newInstance()->getJobsAttrByItemId($id);
    
    if(!empty( $detail['e_relation'] ))
    {
        return $detail['e_relation'];
    }else{
        return false;
    }
}
return;
}

function job_get_Type($id){
if( is_job_enabled() ){
    $detail = ModelJobs::newInstance()->getJobsAttrByItemId($id);

    if(!empty( $detail['e_position_type'] ))
    {
        return $detail['e_position_type'];
    }else{
        return false;
    }
}
return;
}

// To the Top Script
function falgun_to_the_top_script(){ ?>
    <script>
    jQuery(document).ready(function($){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('#myBtn').fadeIn('slow');
        } else {
            $('#myBtn').fadeOut('slow');
        }
    });
    $('#myBtn').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1800);
        return false;
    });
});
</script>
<?php }
if ( osc_get_preference('to_the_top', 'falgun') == 1 ) {
    osc_add_hook('footer', 'falgun_to_the_top_script');
}

/*

    ads  SEARCH

 */
if (!function_exists('search_ads_listing_top_fn')) {
    function search_ads_listing_top_fn() {
        if(osc_get_preference('search-results-top-728x90', 'falgun')!='') {
            echo '<div class="clear"></div>' . PHP_EOL;
            echo '<div class="ads_header ads-headers">' . PHP_EOL;
            echo osc_get_preference('search-results-top-728x90', 'falgun');
            echo '</div>' . PHP_EOL;
            echo '</br>';
        }
    }
}
osc_add_hook('search_ads_listing_top', 'search_ads_listing_top_fn');

if (!function_exists('search_ads_listing_medium_fn')) {
    function search_ads_listing_medium_fn() {
        if(osc_get_preference('search-results-middle-728x90', 'falgun')!='') {
            echo '<div class="clear"></div>' . PHP_EOL;
            echo '<div class="ads_header ads-headers">' . PHP_EOL;
            echo osc_get_preference('search-results-middle-728x90', 'falgun');
            echo '</div>' . PHP_EOL;
        }
    }
}
osc_add_hook('search_ads_listing_medium', 'search_ads_listing_medium_fn');
?>
