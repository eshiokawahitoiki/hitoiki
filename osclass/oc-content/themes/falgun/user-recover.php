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

    // meta tag robots
    osc_add_hook('header','falgun_nofollow_construct');

    falgun_add_body_class('recover');
    osc_current_web_theme_path('header.php');
?> 
<div class="row" id="form-row">   
    <div class="col-lg-6 col-md-7 item-post" id="form-login">
        <div class="form-login">
            <div class="form-row-header"> 
                <h1 id="form-row-h1"><?php _e('Recover your password', 'falgun'); ?></h1>
            </div>
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="recover_post" />
                    <div class="control-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'falgun'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_text(); ?>
                            <?php osc_show_recaptcha('recover_password'); ?>
                        </div>
                    </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-md"><?php _e("Send me a new password", 'falgun');?></button>
                            </div>
                        </div><br><br>
                </form>
        </div>
    </div>  
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>