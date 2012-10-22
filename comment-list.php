<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
if('pingback'==$comment->comment_type || 'trackback'==$comment->comment_type):
?>
<li class="post pingback">
    <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></p>
</li>
<?php
else:
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="userinfo" id="comment-<?php comment_ID(); ?>"><?php echo get_avatar( $comment, 35 );?> <em><?php comment_author_link();?></em> <?php comment_date();?> <?php comment_time();?> 
                            <?php  if($comment->comment_approved == '0'): ?>
                              <span class="badge badge-warning">评论审核中</span>
                          <?php endif;?>
                    </div>
                    
                    <div class="content depth<?php echo $depth;?>"><?php comment_text(); ?></div>
                    <div class="control">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' =>'回复', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> 
                        <?php edit_comment_link('编辑','　'); ?>
                    </div>
</li>
<?php
endif;
?>