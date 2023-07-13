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
<div id="list-view">
    <div id="listing-view">
        <div id="loop-single-listpremium-col">
            <div class="row listing-card <?php echo $class; ?> premium">
                <div class="col_col col-lg-3 col-md-4">
                        <div id="list-images">
                            <?php if( osc_images_enabled_at_items() ) { ?>
                                <?php if(osc_count_premium_resources()) { ?>
                                <div class="listing-thumb-premium-color">
                                    <a class="listing-thumb" href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><img src="<?php echo osc_resource_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" ></a>
                                </div>
                                <?php } else { ?>
                                <div class="listing-thumb-color">
                                    <a class="listing-thumb" href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" ></a>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                </div>
                <div class = "col_col col-lg-9 col-md-8">
                    <div class="listing-detail">
                        <span class="ribbon">
                            <span>
                                <i class="fas fa-star"></i><?php _e('Premium','falgun');?>
                            </span> 
                        </span>
                        <div class="listing-basicinfo">
                            <a href="<?php echo osc_premium_url() ; ?>" class="title" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><?php echo osc_premium_title() ; ?></a><br>
                            <?php if ( is_job_enabled() ) { ?>
                                <?php if ( !EMPTY(job_get_Type(osc_premium_ID())) ) { ?>
                                    <div class="falgun-type col-md-6"><?php echo job_get_Type(osc_premium_ID()); ?> TIME</div>
                                    <div class="falgun-relation col-md-6"><?php echo job_get_Relation(osc_premium_ID()); ?> </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="listing-list">
                                <span class="category"><?php echo osc_premium_category() ; ?></span><br>
                                <?php if( osc_price_enabled_at_items() ) { ?>
                                    <?php if( !EMPTY(osc_premium_price()) ) { ?>
                                        <span class="currency-value">Salary <?php echo osc_premium_formated_price(osc_premium_price()); ?></span><br>
                                    <?php } ?>
                                <?php } ?>
                                <div id="listing-grid-date"><i class="far fa-calendar"></i><span class="g-hide"></span> <?php echo osc_format_date(osc_premium_pub_date()); ?></div>                      
                            
                                <p><?php echo osc_highlight( osc_premium_description(), 100 ); ?></p>
                                <i class="fas fa-map-marker-alt"></i><span class="location"><?php if( osc_premium_city()!='' ) { echo osc_premium_city().', '; } ?><?php if( osc_premium_region()!='' ) { ?><?php echo osc_premium_region(); ?><?php } ?></span>
                            </div>
                            <?php if($admin){ ?>
                                <span class="admin-options">
                                    <a href="<?php echo osc_premium_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'falgun'); ?></a>
                                    <span>|</span>
                                    <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'falgun')); ?>')" href="<?php echo osc_premium_delete_url();?>" ><?php _e('Delete', 'falgun'); ?></a>
                                    <?php if(osc_premium_is_inactive()) {?>
                                    <span>|</span>
                                    <a href="<?php echo osc_premium_activate_url();?>" ><?php _e('Activate', 'falgun'); ?></a>
                                    <?php } ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>