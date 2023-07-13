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
</div><!-- content -->
</div><!-- container -->
</div>
<?php osc_run_hook('after-main'); ?>
</div>

<div id="responsive-trigger"></div>
<!-- footer -->
<div class="clear"></div>
<?php osc_show_widgets('footer');?>
<div id="footer">
     <div class="container">  
      <div class="row" id="footer-row">
      <div class="col-lg-4 col-md-6">
       <h1 id="footer-contact-heading"><?php _e('CONTACT INFO', 'falgun'); ?></h1>
        <?php if ( !EMPTY(osc_get_preference('contact_numbr', 'falgun')) || !EMPTY(osc_get_preference('contact_email', 'falgun')) ) { ?>
              <div class="contact-list">
                <?php if ( !EMPTY(osc_get_preference('contact_numbr', 'falgun')) ) { ?>
                  <i class = "fas fa-phone" ></i>Call Us Now: <?php _e(osc_get_preference('contact_numbr', 'falgun')) ; ?>
                <?php } ?><br>
                <?php if ( !EMPTY(osc_get_preference('contact_email', 'falgun')) ) { ?>
                  <i class="far fa-envelope"></i>E-mail: <?php _e(osc_get_preference('contact_email', 'falgun')) ; ?>
                <?php } ?>
              </div>  
        <?php } ?>
        <li class="footer-contact">
            <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'falgun'); ?></a>
        </li>
        <?php if(falgun_footer_msg()){ ?>
            <li class="footer-msg">
                <?php echo falgun_footer_msg(); ?>
            </li>
        <?php } ?>

      </div>
      <div class="col-lg-2 col-md-6 socialmedia-footer" style="text-align: left;">
            <h1><?php _e('Follow us', 'falgun') ; ?></h1> 
            <div class="socialmedia">
                <?php $social = unserialize ( osc_get_preference ( 'social', 'falgun' ) ) ; ?>
                <?php if(osc_esc_html($social['facebook'])){?>
                    <a class="facebook" href="<?php echo osc_esc_html($social['facebook'])?:'#'?>" target = "_blank" ><i class="fab fa-facebook-f"></i>facebook</a><br>
                <?php }?>
                <?php if(osc_esc_html($social['twitter'])){?>
                    <a class="twitter" href="<?php echo osc_esc_html($social['twitter'])?:'#'?>" target = "_blank" ><i class="fab fa-twitter"></i>twitter</a><br>
                <?php }?>
                <?php if(osc_esc_html($social['linkedin'])){?>
                    <a class="linkedin" href="<?php echo osc_esc_html($social['linkedin'])?:'#'?>" target = "_blank" ><i class="fab fa-linkedin-in"></i>linkedin</a><br>
                <?php }?>
                <?php if(osc_esc_html($social['google'])){?>
                    <a class="google" href="<?php echo osc_esc_html($social['google'])?:'#'?>" target = "_blank" ><i class="fab fa-google-plus-g"></i>google</a><br>
                <?php }?>
                <?php if(osc_esc_html($social['instagram'])){?>
                    <a class="instagram" href="<?php echo osc_esc_html($social['instagram'])?:'#'?>" target = "_blank" ><i class="fab fa-instagram"></i>instagram</a><br>
                <?php }?>
                <?php if(osc_esc_html($social['youtube'])){?>
                    <a class="youtube" href="<?php echo osc_esc_html($social['youtube'])?:'#'?>" target = "_blank" ><i class="fab fa-youtube" aria-hidden="true"></i>youtube</a>
                <?php }?>
            </div>     
        </div>
       <div class="col-lg-3 col-md-6">
       <h1><?php _e('USER', 'falgun'); ?></h1>
        <ul class="resp-toggle">
            <?php if( osc_users_enabled() ) { ?>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li>
                    <i class = "fas fa-user" ></i><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My Account', 'falgun'); ?></a><br>
                    <i class = "fas fa-sign-out-alt" ></i><a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Sign Out', 'falgun'); ?></a>
                </li>
            <?php } else { ?>
                <?php if(osc_user_registration_enabled()) { ?>
                    <li>
                        <i class = "fas fa-pencil-alt" ></i><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Join Us', 'falgun'); ?></a>
                    </li>
                <?php } ?>
                <li><i class = "fas fa-sign-in-alt" ></i><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Sign In', 'falgun'); ?></a></li>
            <?php } ?>
            <?php } ?>
            <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <li class="publish">
                <i class = "fas fa-edit" ></i><a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Post New Job", 'falgun');?></a>
            </li>
            <?php } ?>
        </ul>
       </div>
  
        <div class="col-lg-3 col-md-6 footer-pages"> 
           <h1><?php _e('PAGES', 'falgun'); ?></h1>
            <ul class="pages">
            <?php
            osc_reset_static_pages();
            while( osc_has_static_pages() ) { ?>
                <li>
                    <a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
                </li>
            <?php
            }
            ?>
            </ul>
       </div>  </div>
        <?php
            echo '<div class="copyright">' . sprintf(__('Free responsive Osclass theme by <a target="_blank" title="Osclass" href="%s">Osclass</a>','falgun'), 'https://osclass.in/') . '</div>';
        ?> 
    </div>
</div>
   
<?php if ( osc_get_preference('to_the_top', 'falgun') == 1 ) { ?>
    <button id="myBtn" title="Go to top" style="display: block;"><i class="fa fa-caret-up"></i></button>
<?php } ?>

<?php osc_run_hook('footer'); ?>
</body></html>
