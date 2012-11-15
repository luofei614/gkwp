<?php
$args=array(
    'showposts'=>$instance['number']
);
if($instance['thumb']){
    $args['meta_key']='_thumbnail_id';
}
if($instance['cat_id']){
    $args['cat']=$instance['cat_id'];
}
query_posts($args);
echo $before_widget;
 if ( $instance['title'] )
            echo $before_title . $instance['title'] . $after_title;
?>

<ul>
    <?php
        while(have_posts()): the_post();
    ?>
    <li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
    <?php
        endwhile;
    ?>
</ul>
<?php if($instance['cat_id']):?>
    <div class="more"><a href="<?php echo get_term_link($instance['cat_id'],'category')?>">更多>></a></div>
<?php
endif;
echo $after_widget;
wp_reset_query();//重置查询条件
