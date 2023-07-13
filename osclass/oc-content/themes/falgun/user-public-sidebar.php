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
<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#user-public-sidebar"><?php _e('Contact Publisher', 'falgun') ; ?></button>
<?php if(osc_logged_user_id() !=  osc_user_id()) { ?>
    <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
    <div class="modal fade" id="user-public-sidebar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="item-post" id="form-login">
                <div class="form-login">
                    <div class="form-row-header">
                        <h1 id="form-row-h1"><?php _e("Contact", 'falgun'); ?></h1>
                    </div>    
                    <ul id="error_list"></ul>
                    <form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form">
                        <input type="hidden" name="action" value="contact_post" />
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="id" value="<?php echo osc_user_id();?>" />
                        <div class="control-group">
                            <label class="control-label" for="yourName"><?php _e('Your name', 'falgun'); ?>:</label>
                            <div class="controls"><?php ContactForm::your_name(); ?></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="yourEmail"><?php _e('Your email address', 'falgun'); ?>:</label>
                            <div class="controls"><?php ContactForm::your_email(); ?></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phoneNumber"><?php _e('Phone number', 'falgun'); ?> (<?php _e('optional', 'falgun'); ?>):</label>
                            <div class="controls"><?php ContactForm::your_phone_number(); ?></div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="message"><?php _e('Message', 'falgun'); ?>:</label>
                            <div class="controls textarea"><?php ContactForm::your_message(); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?php osc_run_hook('item_contact_form', osc_item_id()); ?>
                                <?php if( osc_recaptcha_public_key() ) { ?>
                                    <script type="text/javascript">
                                        var RecaptchaOptions = {
                                            theme : 'custom',
                                            custom_theme_widget: 'recaptcha_widget'
                                        };
                                    </script>
                                    <style type="text/css"> div#recaptcha_widget, div#recaptcha_image > img { width:280px; } </style>
                                    <div id="recaptcha_widget">
                                        <div id="recaptcha_image"><img /></div>
                                        <span class="recaptcha_only_if_image"><?php _e('Enter the words above','falgun'); ?>:</span>
                                        <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                        <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'falgun'); ?></a></div>
                                    </div>
                                <?php } ?>
                                <?php osc_show_recaptcha(); ?>
                                <button type="submit" class="btn btn-md"><?php _e("Send", 'falgun');?></button>
                            </div><br>
                        </div>
                    </form>
                <?php ContactForm::js_validation(); ?>
            </div>    
        </div>
    </div>
    </div>    
</div>
<?php }
} ?>