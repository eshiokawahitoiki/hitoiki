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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('common/head.php') ; ?>
    </head>
<body <?php falgun_body_class(); ?>>
  <div class="clear"></div>
    <nav class="navbar navbar-default"> 
          <div class="container">
             <?php if ( !EMPTY(osc_get_preference('contact_numbr', 'falgun')) || !EMPTY(osc_get_preference('contact_email', 'falgun')) ) { ?>
              <div class="contact-list navbar-left">
                <?php if ( !EMPTY(osc_get_preference('contact_numbr', 'falgun')) ) { ?>
                  <i class = "fas fa-phone" ></i><?php _e(osc_get_preference('contact_numbr', 'falgun')) ; ?><br>
                <?php } ?>
                <?php if ( !EMPTY(osc_get_preference('contact_email', 'falgun')) ) { ?>
                  <i class="far fa-envelope"></i><?php _e(osc_get_preference('contact_email', 'falgun')) ; ?>
                <?php } ?>
              </div>  
             <?php } ?>    
            <ul class="nav navbar-nav navbar-right"> 
              <?php if( osc_users_enabled() ) { ?>
                <?php if( osc_is_web_user_logged_in() ) { ?>
                  <li class="first logged">
                      <a class="name"><?php echo sprintf(__('Hi %s', 'falgun'), osc_logged_user_name() . '!'); ?></a>
                      <div class="btn btn-user btn-lg btn-logout"><i class = "fas fa-user" ></i><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'falgun'); ?></a></div>
                      <div class="btn btn-info btn-lg btn-logout"><i class="fas fa-sign-out-alt"></i><a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Sign Out', 'falgun'); ?></a></div>
                  </li>
                <?php } else { ?>
                  <?php if(osc_user_registration_enabled()) { ?>
                    <div class="btn btn-info btn-lg btn-joinus"><i class="fas fa-pencil-alt"></i><li class="register"><a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Join Us', 'falgun'); ?></a></li></div>
                  <?php }; ?>
                  <div class="btn btn-info btn-lg btn-login"><i class="fas fa-sign-in-alt"></i><li class="login"><a id="login" href="<?php echo osc_user_login_url(); ?>"><?php _e('Sign In', 'falgun') ; ?></a></li></div>
                <?php }; ?>
                  <?php if(osc_user_registration_enabled()) { ?>
              <?php } ?>
              <?php } ?> 
              <li class="language dropdown">
                  <?php ?>
                  <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                  <?php osc_goto_first_locale(); ?>
                  <button class="btn btn-lg" type="button" data-toggle="dropdown">
                  <?php _e('Language:', 'falgun'); ?>
                  <span>
                  <?php $local = osc_get_current_user_locale(); echo $local['s_name']; ?>
                  <i class="fa fa-caret-down"></i></span></button>
                  <ul class="dropdown-menu">
                    <?php $i = 0;  ?>
                    <?php while ( osc_has_web_enabled_locales() ) { ?>
                    <li style="display: inline-flex;"><?php if( osc_locale_code() ) { ?><img src="<?php echo osc_current_web_theme_url('images/flags/'. osc_locale_code() .'.png') ; ?>" style = "height: 17px; width: 17px; margin-top: 4px;" /><?php } ?><a <?php if(osc_locale_code() == osc_current_user_locale() ) echo "class=active"; ?> id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><?php echo osc_locale_name(); ?></a></li><br>
                    <?php if( $i == 0 ) { echo ""; } ?>
                    <?php $i++; ?>
                    <?php } ?>
                  </ul>
                  <?php } ?>
                </li> 
          </ul>
        </div>
    </nav>  

      <nav class="navbar navbar-expand-lg">
        <div class="container"> 
                    <div class="navbar-brand">
                        <?php echo logo_header(); ?>
                    </div>

                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                      
                    </button>

                <div class="collapse navbar-collapse" id="navbar-collapse">

                    <ul class="navbar-nav" id="main-navbar">
                      <?php
                     while( osc_has_static_pages() ) { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
                    </li>
                   <?php
                   }
                   osc_reset_static_pages();
                   ?>
                   <li class="nav-item">
                       <a class="nav-link" href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'falgun'); ?></a>
                   </li>
                 </ul>
                </div>
            </div>
      </nav>       

<?php if ( osc_is_home_page() ) { ?>
<?php if ( osc_get_preference('show_banner', 'falgun') == 1 ) { ?>
<div id="background">
   <div class="background-one col-md-6">
    <div class="container background-one-container">
      <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
        <?php if ( !EMPTY(osc_get_preference('post_job_heading', 'falgun')) || !EMPTY(osc_get_preference('post_job_description', 'falgun')) ) { ?>
            <?php if ( !EMPTY(osc_get_preference('post_job_heading', 'falgun')) ) { ?>
              <h3><?php _e(osc_get_preference('post_job_heading', 'falgun')) ; ?></h3><br>
            <?php } ?>
            <?php if ( !EMPTY(osc_get_preference('post_job_description', 'falgun')) ) { ?>
              <p><?php _e(osc_get_preference('post_job_description', 'falgun')) ; ?></p>
            <?php } ?>
        <?php } ?>
          <div class="publish"><a href="<?php echo osc_item_post_url_in_category() ; ?>"><i class = "fa fa-edit" ></i><?php _e("Post Job", 'falgun');?></a></div>
        <?php } ?>
    </div>  
   </div>   

    <div class="background-two col-md-6">
      <?php if ( !EMPTY(osc_get_preference('browse_job_heading', 'falgun')) || !EMPTY(osc_get_preference('browse_job_description', 'falgun')) ) { ?>
        <div class="container background-two-container">
          <?php if ( !EMPTY(osc_get_preference('browse_job_heading', 'falgun')) ) { ?>
            <h3><?php _e(osc_get_preference('browse_job_heading', 'falgun')) ; ?></h3><br>
          <?php } ?>
          <?php if ( !EMPTY(osc_get_preference('browse_job_description', 'falgun')) ) { ?>
            <p><?php _e(osc_get_preference('browse_job_description', 'falgun')) ; ?></p>
          <?php } ?>  
      <?php } ?>

      <?php if( is_job_enabled() ) { ?>
        <div class="quick-search">
          <form action="<?php echo osc_base_url(true); ?>" id="falgun_search" method="get" class="search nocsrf" >
            <input type="hidden" name="page" value="search"/>
              <div class="row" id="main-search-second-row">
                <div class="falgun-relation col-sm-6">
                  <div class="cell">
                      <select name="relation" id="relation">
                        <option value="" <?php echo (Params::getParam('relation')=='')?'selected':''; ?>><?php _e('Job Relation', 'falgun'); ?></option>
                        <option value="HIRE" <?php echo (Params::getParam('relation')=='HIRE')?'selected':''; ?>><?php _e('Hire someone', 'falgun'); ?></option>
                        <option value="LOOK" <?php echo (Params::getParam('relation')=='LOOK')?'selected':''; ?>><?php _e('Looking for a job', 'falgun'); ?></option>
                      </select>
                  </div>
                </div>
          
                <div class="position-type col-sm-6">
                  <div class="cell">
                      <select name="positionType" id="positionType">
                        <option value="UNDEF" <?php echo (Params::getParam('positionType')=='UNDEF')?'selected':''; ?>><?php _e('Position Type', 'falgun'); ?></option>
                        <option value="FULL" <?php echo (Params::getParam('positionType')=='FULL')?'selected':''; ?>><?php _e('Full-time', 'falgun'); ?></option>
                        <option value="PART" <?php echo (Params::getParam('positionType')=='PART')?'selected':''; ?>><?php _e('Part time', 'falgun'); ?></option>
                      </select>
                  </div>
                </div>          
                    
                <div class="cell reset-padding">
                  <button  class="browse btn btn-md"><i class="fa fa-search"></i> <span>
                    <?php _e("Browse Jobs", 'falgun');?>
                  </span> </button>
                </div>
              </div>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>
</div>  
<?php } ?>  

    <div id="search-boxes">
      <div class="container" id="main-search-container">
        <h1><?php _e('Search Your Dream Job', 'falgun'); ?></h1>
        <div class="banner_none" id="form_vh_map">
        <form action="<?php echo osc_base_url(true); ?>" id="main_search" method="get" class="search nocsrf" >
            <input type="hidden" name="page" value="search"/>
            <div class="main-searches">
              <div class="form-filters">
                <div class="row" id="main-search-first-row">
                  <?php $showCountry  = (osc_get_preference('show_search_country', 'falgun') == '1') ? true : false; ?>
                  <div class="col-lg-3 col-md-6">
                    <div class="cell">
                      <input type="text" name="sPattern" id="query" class="input-text" value="" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'falgun'), 'falgun')); ?>" />
                    </div>
                  </div>
                  <?php if($showCountry) { ?>
                  <div class="col-lg-3 col-md-6">
                    <div class="cell selector">
                      <?php falgun_countries_select('sCountry', 'sCountry', __('Select a country', 'falgun'));?>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="col-lg-3 col-md-6">
                    <div class="cell selector">
                      <?php falgun_regions_select('sRegion', 'sRegion', __('Select a region', 'falgun')) ; ?>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="cell selector">
                      <?php falgun_cities_select('sCity', 'sCity', __('Select a city', 'falgun')) ; ?>
                    </div>
                  </div>
                  
                </div>

                <div class="row" id="main-search-second-row">
                  <?php if( is_job_enabled() ){ ?>
                    <div class="col-sm-6">
                      <div class="cell">
                        <select name="relation" id="relation">
                          <option value="" <?php echo (Params::getParam('relation')=='')?'selected':''; ?>><?php _e('Job Relation', 'falgun'); ?></option>
                          <option value="HIRE" <?php echo (Params::getParam('relation')=='HIRE')?'selected':''; ?>><?php _e('Hire someone', 'falgun'); ?></option>
                          <option value="LOOK" <?php echo (Params::getParam('relation')=='LOOK')?'selected':''; ?>><?php _e('Looking for a job', 'falgun'); ?></option>
                        </select>
                      </div>
                  </div>
          
                  <div class="col-sm-6">
                    <div class="cell">
                      <select name="positionType" id="positionType">
                        <option value="UNDEF" <?php echo (Params::getParam('positionType')=='UNDEF')?'selected':''; ?>><?php _e('Position Type', 'falgun'); ?></option>
                        <option value="FULL" <?php echo (Params::getParam('positionType')=='FULL')?'selected':''; ?>><?php _e('Full-time', 'falgun'); ?></option>
                        <option value="PART" <?php echo (Params::getParam('positionType')=='PART')?'selected':''; ?>><?php _e('Part time', 'falgun'); ?></option>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>

                <div class="row" id="main-search-third-row">
                  <div class="col-lg-3 col-md-6">
                    <?php  if ( osc_count_categories() ) { ?>
                    <div class="cell selector">
                      <?php osc_categories_select('sCategory', null, osc_esc_html(__('Select job category', 'falgun'))) ; ?>
                    </div>
                    <?php  } ?>
                  </div>    
                  
                  <div class="col-sm-6">
                    <div class="cell">
                      <div class="row" id="price-range-row">
                        <div class="col-sm-6">
                          <input placeholder="<?php echo osc_esc_html( __( "Min Salary", "falgun" ) ) ; ?>" onkeypress='OsWizValidate(event)' class="input-text" type="text" id="priceMin" name="sPriceMin" size="12" maxlength="12" />
                        </div>
                        <div class="col-sm-6">
                          <input placeholder="<?php echo osc_esc_html( __( "Max Salary", "falgun" ) ) ; ?>" onkeypress='OsWizValidate(event)' class="input-text" type="text" id="priceMax" name="sPriceMax" size="12" maxlength="12" />
                        </div>
                      </div>
                    </div>
                  </div> 

                <div class="col-lg-3 col-md-6">
                    <div class="cell reset-padding">
                      <button  class="btn btn-md"><i class="fa fa-search"></i> <span <?php echo ($showCountry)? '' : 'class="showLabel"'; ?>>
                      <?php _e("Find Job", 'falgun');?>
                      </span> </button>
                    </div>
                  </div>
              </div>
            </div>
              <div id="message-seach"></div>
            </div>
        </form>
      </div>  
      <?php } ?>  
     </div> 
    </div>

<?php osc_show_widgets('header'); ?>
<div id="breadcrumb">
  <?php
    $breadcrumb = osc_breadcrumb('&raquo;', false, get_breadcrumb_lang());
    if( $breadcrumb !== '') { ?>
      <div class="breadcrumb">
        <div class="container">
          <?php echo $breadcrumb; ?>
          <div class="clear"></div>
        </div>  
      </div>
    <?php
    } ?>
  <?php osc_show_flash_message(); ?>
</div>
<?php osc_run_hook('before-content'); ?>
  <div class="container">
    <?php if(osc_is_home_page() ){ ?>
<?php if( osc_get_preference('header-728x90', 'falgun') !=""){ ?>
<div class="ads_header ads-headers"> <?php echo osc_get_preference('header-728x90', 'falgun'); ?> </div>
<?php } ?>
<?php } ?>
    <div id="content">
        <?php osc_run_hook('inside-main'); ?>
        