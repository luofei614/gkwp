<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-header clearfix">
            <?php
            if(comments_open() && !post_password_required()):
            ?>
            <div class="num pull-right">
              <?php comments_popup_link('<span class="badge badge-warning">没有评论</span>','<span class="badge badge-success">有1人评论</span>','<span class="badge badge-info">有%人评论</span>') ?>
            </div>
            <?php
            endif;
            ?>
            <h3><a href="<?php the_permalink();?>" title="<?php the_title_attribute()?>"><?php the_title();?></a></h3>
            <?php
            if('post'==get_post_type()):
            ?>
            <small><?php echo get_the_author();?>发布于<?php the_date('m/d/Y H:i');?> | <strong>分类：</strong><?php echo get_the_category_list(',')?> <?php
            if($tags=get_the_tag_list('',',')) echo ' | <strong>标签</strong>：'.$tags;
            ?></small>
            <?php
            endif;
            ?>
    </div>
    <div class="content">
        <?php 
        is_search()?the_excerpt():the_content('阅读全文→');
        ?>
        <?php edit_post_link( '<span class="label">编辑</span>'); ?>
    </div>
</article>
<?php
if(is_single() || is_page()){
    if('post'==get_post_type() && ($tags=get_the_tag_list('',','))){
    echo '<div class="tag"><strong>标签：</strong>'.$tags.'</div>';
    }
    comments_template( '', true );
}
?>
