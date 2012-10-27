<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */

    $GLOBALS['comment'] = $comment;
    if ( 'pingback' == $comment->comment_type OR 'trackback' == $comment->comment_type ) : ?>
    
        <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <p class="row">
                <strong class="ping-label span1"><?php _e( '引用通告:', 'gkwp' ); ?></strong>
                <span class="span6"><?php comment_author_link(); edit_comment_link( __( '编辑', 'gkwp' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
            </p>
    
    <?php else:
        $offset =   $depth - 1;
        $span   =   6 - $offset; ?>
        
        <li  id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <article id="comment-<?php comment_ID(); ?>" class="comment row">
                <div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
                    <?php echo get_avatar( $comment, 70 ); ?>
                </div>
                <footer class="comment-meta span<?php echo $span; ?>">
                    <p class="comment-author vcard">
                        <?php
                            /* translators: 1: comment author, 2: date and time */
                            printf( __( '%1$s 发布于 %2$s:', 'gkwp' ),
                                sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                    esc_url( get_comment_link( $comment->comment_ID ) ),
                                    get_comment_time( 'c' ),
                                    /* translators: 1: date, 2: time */
                                    sprintf( __( '%1$s - %2$s', 'gkwp' ), get_comment_date(), get_comment_time() )
                                )
                            );
                            edit_comment_link( __( '编辑', 'gkwp' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
                    </p><!-- .comment-author .vcard -->
    
                    <?php if ( ! $comment->comment_approved ) : ?>
                    <div class="comment-awaiting-moderation alert alert-info"><em><?php _e( '你的评论正在审核中', 'gkwp' ); ?></em></div>
                    <?php endif; ?>
    
                </footer><!-- .comment-meta -->
    
                <div class="comment-content span<?php echo $span; ?>">
                    <?php
                    comment_text();
                    comment_reply_link( array_merge( $args, array(
                        'reply_text'    =>  __( '回复 <span>&darr;</span>', 'gkwp' ),
                        'depth'         =>  $depth,
                        'max_depth'     =>  $args['max_depth']
                    ) ) ); ?>
                </div><!-- .comment-content -->
            </article><!-- #comment-<?php comment_ID(); ?> .comment -->
            
    <?php endif; // comment_type