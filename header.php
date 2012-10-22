<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
?><div class="navbar  navbar-inverse navbar-static-top">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".subnav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                  <div class="nav-collapse subnav-collapse">
                    <?php wp_nav_menu( array( 
                        'theme_location' => 'primary',
                        'container' => '',
                        'items_wrap' => '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
                        'fallback_cb'=>'gk_wp_page_menu',
                        'depth'=>1
                    )); ?>
                    <?php get_search_form(); ?>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
      </div><!-- /navbar -->

<div class="container">
  <ul class="thumbnails mt20">
      <li class="span12">
      <div class="thumbnail">
      <img src="<?php header_image(); ?>" alt="">
      </div>
      </li>
  </ul>
</div>