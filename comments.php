<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
?><div class="comment_list mt20">
    <div class="num" id="comments">已有<?php echo get_comments_number();?>条评论</div>
<ul>
    <?php wp_list_comments(array('callback'=>'gk_comments'));?>
</ul>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <div style=" text-align: right;">
            <?php previous_comments_link('上一页'); ?> <?php next_comments_link('下一页'); ?>
        </div>
<?php endif; // check for comment navigation ?>
</div>
<?php comment_form(); ?>