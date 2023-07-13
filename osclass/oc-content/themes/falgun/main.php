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
    osc_add_hook('header','falgun_follow_construct');

    falgun_add_body_class('home');
?>
<?php osc_current_web_theme_path('header.php') ; ?>
 
<div class="clear"></div>
<div class="latest-ads">
<h1><?php _e('Latest Jobs Available', 'falgun') ; ?></h1>
 <?php if( osc_count_latest_items() == 0) { ?>
    <div class="clear"></div>
    <p class="empty"><?php _e("There aren't any jobs available at this moment", 'falgun'); ?></p>
<?php } else { ?>
    <?php
    View::newInstance()->_exportVariableToView("listType", 'latestItems');
    View::newInstance()->_exportVariableToView("listClass",$listClass);
    osc_current_web_theme_path('loop.php');
    ?>
    <div class="clear"></div>
    <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
        <p class="see_more_link"><button type="button" class="btn btn-md"><a href="<?php echo osc_search_show_all_url() ; ?>">
            <?php _e('See all jobs', 'falgun') ; ?> &raquo;</a></button>
        </p>
    <?php } ?>
<?php } ?>
</div>
</div><!-- main -->
<div id="sidebar">
    <?php if(osc_get_preference('show_popular', 'falgun') == '1'){?>
    <h2 class="title"> <?php echo sprintf(__('Most viewed in '.'%s', 'falgun'), osc_page_title()) ; ?> </h2>
    <?php if(falgun_show_popular_searches() ){ ?>
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#Searches"><?php _e('Searches', 'falgun') ; ?></a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#Regions"><?php _e('Regions', 'falgun') ; ?></a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#Cities"><?php _e('Cities', 'falgun') ; ?></a></li>
      </ul>
      <div class="tab-content">
          <section id='Searches' role="tabpanel" class="tab-pane fade in active show">
            <div class="popular-searches">
              <?php $searches = new FalgunLatestSearches ;
              $searches = $searches->falgun_popular_searches( falgun_popular_searches_limit() ) ; ?>
              <?php if(!empty($searches)){ ?>
              <ul>
                <?php foreach($searches as $search){?>
                <?php if($search['s_search'] !=""){?>
                <li><a href="<?php echo osc_search_url(array('sPattern' => $search['s_search'])); ?>"><?php echo  $search['s_search']; ?> <em>(<?php echo $search['total']; ?>)</em></a></li>
                <?php } ?>
                <?php } ?>
              </ul>
                 <?php } ?>
            </div>
          </section>
          <?php } ?>
          <?php if(falgun_show_popular_regions() ){ ?>
          <section id='Regions' role="tabpanel" class="tab-pane fade">
            <div class="popular-regions">
              <?php $regions  =   falgun_popular_regions(falgun_popular_regions_limit()); ?>
               <?php if(!empty($regions)){ ?>
              <ul>
                <?php foreach($regions as $region => $count){?>
                <li><a href="<?php echo osc_search_url( array( 'sRegion' => $region ) ); ?>"><i class="fas fa-map-marker-alt"></i><?php echo $region; ?> <em>(<?php echo $count; ?>)</em></a></li>
                <?php } ?>
              </ul>
                <?php } ?>
            </div>
          </section>
          <?php } ?>
          <?php if(falgun_show_popular_cities() ){ ?>
          <section id='Cities' role="tabpanel" class="tab-pane fade">
            <div class="popular-cities">
              <?php $cities   =   falgun_popular_cities(falgun_popular_cities_limit()); ?>
              <?php if(!empty($cities)){ ?>
              <ul>
                <?php foreach($cities as $city => $count){?>
                <li><a href="<?php echo osc_search_url( array( 'sCity' => $city ) ); ?>"><i class="fas fa-map-marker-alt"></i><?php echo $city; ?> <em>(<?php echo $count; ?>)</em></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
          </section>
          <?php } ?>
        <?php } ?>
      </div> 
</div>
<div class="clear"><!-- do not close, use main clossing tag for this case -->
<?php if( osc_get_preference('homepage-728x90', 'falgun') != '') { ?>
<!-- homepage ad 728x60-->
</br><div class="ads_header ads-headers">
    <?php echo osc_get_preference('homepage-728x90', 'falgun'); ?>
</div>
<!-- /homepage ad 728x60-->
<?php } ?>
<?php osc_current_web_theme_path('footer.php') ; ?>