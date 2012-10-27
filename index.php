<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
get_header('meta');
get_header();
?>
<div class="container">
    <div class="row">
        <div class="span8">
            <?php
                    if(is_search()) echo '<div>搜索“'.get_search_query() .'”的结果：</div>';
                    ?>
                    <?php
                        if(have_posts()):
                    ?>
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', get_post_format() ); ?>

                <?php endwhile; ?>
                <?php /*end the Loop*/?>
                <?php
                //分页
                gk_page($query_string);
                ?>
                <?php
                        else:
                            echo ' <h3> 未找到相关文章</h3>';
                        endif;
                ?>
        </div>
        <section class="span4"><?php  get_sidebar();?></section>
    </div>
</div>
<?php
get_footer();