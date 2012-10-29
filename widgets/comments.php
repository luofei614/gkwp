 <?php
 /**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
  $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments' ) : $instance['title'], $instance, $this->id_base );
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
        $number = 5;
    $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
    echo $before_widget;
    if ( $title )
        echo $before_title . $title . $after_title;

 echo '<ul class="unstyled">';
        if ( $comments ) {
            foreach ( (array) $comments as $comment):
                ?>
            <li class="clearfix gk_comments_list">
                    <div class="pull-left gk_avatar">
                            <a href="<?php echo  esc_url( get_comment_link($comment->comment_ID) ) ?>"><?php echo get_avatar($comment->user_id,50) ;?></a>
                    </div>
                    <div class="pull-right gk_comments">
                            <h3><a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ) ?>"><?php echo get_comment_author_link().' 在  ' .get_the_title($comment->comment_post_ID)?></a></h3>
                            <div>
                                <a href="<?php echo  esc_url( get_comment_link($comment->comment_ID) ) ?>">
                                <?php
                                $comment_c=strip_tags(get_comment_text($comment->comment_ID));
                                echo mb_substr($comment_c, 0,100).(mb_strlen($comment_c)>100?'...':'');
                                ?>
                                </a>
                            </div>
                    </div>
            </li>
            <?php
            endforeach;
        }
        echo '</ul>';
        echo  $after_widget;