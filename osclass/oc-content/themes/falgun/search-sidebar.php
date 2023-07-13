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
     $category = (array)__get("category");
     if(!isset($category['pk_i_id']) ) {
         $category['pk_i_id'] = null;
     }

?>
<div class="col-lg-4 col-md-5">
 <div id="search-sidebar">  
  <div class="search-row">
  <?php osc_alert_form(); ?>
  <div class="filters">
    <h3 id="search-sidebar-heading"><?php _e('Advance search', 'falgun') ; ?></h3>
    <form action="<?php echo osc_base_url(true); ?>" method="get" class="nocsrf">
        <input type="hidden" name="page" value="search"/>
        <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting() ; echo $allowedTypesForSorting[osc_search_order_type()]; ?>" />
        <?php foreach(osc_search_user() as $userId) { ?>
        <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>"/>
        <?php } ?>
        <fieldset class="first">
            <h3><?php _e('Your search', 'falgun'); ?></h3>
                <input class="input-text" type="text" name="sPattern"  id="query" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" />
        </fieldset>
        <fieldset>
            <h3><?php _e('City', 'falgun'); ?></h3>
                <input class="input-text" type="hidden" id="sRegion" name="sRegion" value="<?php echo osc_esc_html(Params::getParam('sRegion')); ?>" />
                <input class="input-text" type="text" id="sCity" name="sCity" value="<?php echo osc_esc_html(osc_search_city()); ?>" />
        </fieldset>
        <?php if( osc_images_enabled_at_items() ) { ?>
        <fieldset>
            <h3 class="show-only"><?php _e('Show only', 'falgun') ; ?></h3>
            <div class="checkbox">
                  <input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?> />
                  <label for="withPicture">
                    <?php _e('listings with pictures', 'falgun') ; ?>
                  </label>
                </div>
        </fieldset>
        <?php } ?>
        <?php if( osc_price_enabled_at_items() ) { ?>
        <fieldset>
            <div class="price-slice">
                <h3><?php _e('Salary', 'falgun') ; ?></h3>
                <input class="input-text" placeholder="Min Salary" type="text" id="priceMin" name="sPriceMin" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6" />
             
                <input class="input-text" placeholder="Max Salary" type="text" id="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="6" />
            </div>
        </fieldset>
        <?php } ?>
        <div class="plugin-hooks">
            <?php
            if(osc_search_category_id()) {
                osc_run_hook('search_form', osc_search_category_id()) ;
            } else {
                osc_run_hook('search_form') ;
            }
            ?>
        </div>
        <?php
        $aCategories = osc_search_category();
        foreach($aCategories as $cat_id) { ?>
            <input type="hidden" name="sCategory[]" value="<?php echo osc_esc_html($cat_id); ?>"/>
        <?php } ?>
        <div class="actions">
            <button type="submit" class="btn btn-md"><?php _e('Apply', 'falgun') ; ?></button>
        </div>
    </form>
  </div> 
 </div>
</div>
    <fieldset id="refine-category-fieldset">
        <h3 id="refine-heading"><?php _e('Refine job category', 'falgun') ; ?></h3>
        <div id="refine">
            <?php falgun_sidebar_category_search($category['pk_i_id']); ?>
        </div>
    </fieldset>
</div>
