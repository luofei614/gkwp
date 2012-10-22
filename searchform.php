<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
?><form class="navbar-search pull-right"  role="search" method="get" id="searchform" action="<?php echo  esc_url( home_url( '/' ) ) ?>">
            <input type="text" class="search-query span2" placeholder="Search" value="<?php get_search_query() ?>" name="s" id="s" />
</form>