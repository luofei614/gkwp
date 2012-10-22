<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
require_once get_template_directory().'/lib/init.php';
//加载子主题的函数
if(file_exists(__ROOT__.'/common.php')) include __ROOT__.'/common.php';

if ( ! isset( $content_width ) )
    $content_width = gk_config('content_width');

add_action( 'after_setup_theme', 'gk_setup' );
if(!function_exists('gk_setup')){
    function gk_setup(){
        //支持语言包
        load_theme_textdomain( 'gkwp', __PROOT__ . '/languages' );
        $languages=gk_config('languages');
        foreach($languages as $name=>$path){
                load_theme_textdomain($name,$path);
        }
        //设置主题支持
        $theme_supports=gk_config('theme_support');
        foreach($theme_supports as $key=>$support){
            is_numeric($key)? add_theme_support($support):add_theme_support($key,$support);
        }
        register_nav_menu( 'primary',__('主菜单','gkwp'));
        //设置缩略图
        $thumbnails=gk_config('thumbnails');
        foreach($thumbnails as $name=>$setting){
                set_post_thumbnail_size($setting[0],$setting[1],$setting[2]);
                add_image_size($name,$setting[0],$setting[1],$setting[2]);
        }
        //支持 register_default_headers
        $register_default_headers_config=gk_config('register_default_headers');
        if(!empty($register_default_headers_config)) register_default_headers($register_default_headers_config);
    }
}

//注册侧栏
add_action( 'widgets_init', 'gk_widgets_init' );
if(!function_exists('gk_widgets_init')){
    function gk_widgets_init(){
        //注册系统widgets
         require_once __PROOT__.'/lib/widgets.php';
        unregister_widget('WP_Widget_Recent_Comments');//禁用默认的评论
        register_widget('gk_comments_widget');//注册新的评论小工具
        //TODU 添加更多小工具
        //注册边栏
        $sidebars=gk_config('sidebar');
        foreach($sidebars as $sidebar){
            unset($sidebar['default']);
            register_sidebar($sidebar);
        }
    }
}

//菜单默认显示首页 
add_filter( 'wp_page_menu_args', 'gk_page_menu_args' );
if(!function_exists('gk_page_menu_args')){
    function gk_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }
}

//选择主题后初始化
add_action('after_switch_theme','gk_after_switch_theme');
if(!function_exists('gk_after_switch_theme')){
    function gk_after_switch_theme(){
        global $_wp_sidebars_widgets;
        //初始化widget
        $widgets=gk_config('widget');
        foreach($widgets as $name=>$setting){
            $arr=explode('-', $name);
            $id=array_pop($arr);
            $name=implode('-', $arr);
            $option=get_option($name);
            if(!$option) $option=array();
            if(!isset($option[$id])){
                $option[$id]=$setting;
                update_option($name,$option);
            }
        }
        //初始化边栏
        $sidebars_option=wp_get_sidebars_widgets();
        $update_sidebar=true;
        $sidebars=gk_config('sidebar');
        foreach($sidebars as $sidebar){
            if(!isset($sidebars_option[$sidebar['id']]) && isset($sidebar['default'])){
                $sidebars_option[$sidebar['id']]=implode(',', $sidebar['default']);
                $update_sidebar=true;
            }
        }
        if($update_sidebar){
            $_wp_sidebars_widgets=$sidebars_option;
            wp_set_sidebars_widgets($sidebars_option);
        }
    }
}



    //分页
if(!function_exists('gk_page')){
    function gk_page($query_string){
        //TUDO 配置页面显示个数
            global $posts_per_page, $paged;   
            $my_query = new WP_Query($query_string ."&posts_per_page=-1");   
            $total_posts = $my_query->post_count; 
            if(empty($paged))$paged = 1;   
            $prev = $paged - 1;   
            $next = $paged + 1;   
            //为0时 只显示 上一页，下一页， 为1时显示最前最后，上一页下一页和数组， 为2时只显示数字
            $range = 1; 
            $showitems = ($range * 2)+1;
            $pages = ceil($total_posts/$posts_per_page); 
            $start=$paged<=5  ?1:$paged-5;
            $end=$pages<5 || $paged+5>$pages?$pages:$paged+5;
            if(1 != $pages){   
            echo '<div class="pagination "><ul>';   
            echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<li><a href='".get_pagenum_link(1)."'>最前一页</a></li":"";   
            echo ($paged > 1 && $showitems < $pages)? "<li><a href='".get_pagenum_link($prev)."'>上一页</a></li>":"";   
              
            for ($i=$start; $i <= $end; $i++){
                $class='';
                if ($paged == $i) $class=' class="active"';
                echo '<li'.$class.'><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
            }   
              
            echo ($paged < $pages && $showitems < $pages) ? "<li><a href='".get_pagenum_link($next)."'>下一页</a></li>" :"";   
            echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<li><a href='".get_pagenum_link($pages)."'>最后一页</a></li>":"";   
            echo "</ul></div>\n";   
            }   
    }
}
//加载css
if(!function_exists('gk_load_css')){
    function gk_load_css(){
        //注册css
        gk_register_styles();
        $css_config=gk_config('css');
        foreach($css_config as $css){
            $before='';
            $after='';
            if(is_array($css)){
                //支持 is_page(), is_home() 等函数判断加载
                if(is_bool($css[0])){
                    if(!$css[0])  continue;
                }else{
                    $before='<!--[if '.$css[0].']>';
                    $after='<![endif]-->';
                }
                $css=$css[1];
            }
            $pathinfo=pathinfo($css);
            $ext=isset($pathinfo['extension'])?$pathinfo['extension']:'';
            if('css'!=$ext){
                //列队名称载入
                if(wp_style_is($css)) continue;//如果已经有列队，则不会重复载入
                global $wp_styles;
                $css_url=$wp_styles->registered[$css]->src;
            }else{
                $css_url=filter_var($css,FILTER_VALIDATE_URL)?$css:get_gk_url($css);
            }
            
            echo $before.PHP_EOL;
            echo '<link rel="stylesheet" type="text/css" href="'.$css_url.'" media="all">'.PHP_EOL;
            echo $after.PHP_EOL;
        }
    }
}

if(!function_exists('gk_register_styles')){
    function gk_register_styles(){
        $register_css=gk_config('register_css');
        foreach($register_css as $name=>$r_css){
            if(!filter_var($r_css,FILTER_VALIDATE_URL)) $r_css=get_gk_url($r_css);
            wp_deregister_style($name);
            wp_register_style($name,$r_css);
        }
    }
}

//注册script
add_action('wp_enqueue_scripts', 'gk_register_scripts');
if(!function_exists('gk_register_scripts')){
    function gk_register_scripts() {
        $register_js=gk_config('register_js');
        foreach($register_js as $name=>$js){
            if(!filter_var($js,FILTER_VALIDATE_URL)) $js=get_gk_url($js);
            wp_deregister_script( $name);
            wp_register_script( $name,$js );
        }   
    }
}

//加载js
if(!function_exists('gk_load_js')){
    function gk_load_js(){
        $js_config=gk_config('js');
        foreach($js_config as $js){
            $before='';
            $after='';
            if(is_array($js)){
                //支持 is_page(), is_home() 等函数判断加载
                if(is_bool($js[0])){
                   if(!$js[0]) continue;
                }else{
                    $before='<!--[if '.$js[0].']>';
                    $after='<![endif]-->';
                }
                $js=$js[1];
            }
            $pathinfo=pathinfo($js);
            $ext=isset($pathinfo['extension'])?$pathinfo['extension']:'';
            if('js'!=$ext){
                //用列队名称载入
                if(wp_script_is($js)) continue; //如果已经载入，则不再重复载入
                global $wp_scripts;
                $js_url=$wp_scripts->registered[$js]->src;
            }else{
                    $js_url=filter_var($js,FILTER_VALIDATE_URL)?$js:get_gk_url($js);
            }
            echo $before.PHP_EOL;
            echo '<script type="text/javascript" src="'.$js_url.'"></script>'.PHP_EOL;
            echo $after.PHP_EOL;
        }
    }
}
//主题选项
add_action( 'admin_init', 'gk_theme_options_init' );
add_action( 'admin_menu', 'gk_theme_options_add_page' );

if(!function_exists('gk_theme_options_init')){
    function gk_theme_options_init(){
        //注册设置组
        $theme_options=gk_config('theme_options');
        foreach($theme_options as $name=>$setting){
            $callback='';
            if(is_string($setting)) $setting=array($setting);
            if(isset($setting[1])) $callback=$setting[1];
            register_setting($name, $name,$callback );
        }
    }
}

if(!function_exists('gk_theme_options_add_page')){
    function gk_theme_options_add_page(){
        $theme_options=gk_config('theme_options');
        foreach($theme_options as $name=>$setting){
            if(is_string($setting)) $setting=array($setting);
            add_theme_page($setting[0],$setting[0],'edit_theme_options',$name,'gk_theme_options_show_page');
        }
        //加载后台静态文件
        add_action('admin_print_scripts', 'gk_admin_scripts');
        add_action('admin_print_styles', 'gk_admin_styles');
    }
}
if(!function_exists('gk_theme_options_show_page')){
    function gk_theme_options_show_page(){
        $option_name=basename($_GET['page']);
        include get_gk_file('options/'.$option_name.'.php');
    }
}

if(!function_exists('gk_admin_scripts')){
    function gk_admin_scripts(){
        wp_enqueue_script('jquery');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('gk-upload',get_gk_url('static/js/gk-upload.js'));
    }
}

if(!function_exists('gk_admin_styles')){
    function gk_admin_styles(){
        wp_enqueue_style('thickbox');
    }
}
if(!function_exists('gk_upload')){
    function gk_upload($name,$value,$class='gk_upload',$label='选择文件'){
    echo '<input name="'.$name.'" type="text" id="'.$name.'" value="'.$value.'" class="'.$class.'" /><input type="button"  name="left_upload_button" class="gk_upload_button" value="'.$label.'"  />';
    }
}

//修改默认菜单样式
//TODU,支持二级菜单
if(!function_exists('gk_wp_page_menu')){
function gk_wp_page_menu( $args = array() ) {
    $defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_page_menu_args', $args );

    $menu = '';

    $list_args = $args;

    // Show Home in the menu
    if ( ! empty($args['show_home']) ) {
        if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
            $text = __('Home');
        else
            $text = $args['show_home'];
        $class = '';
        if ( is_front_page() && !is_paged() )
            $class = 'class="current_page_item"';
        $menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
        // If the front page is a page, add it to the exclude list
        if (get_option('show_on_front') == 'page') {
            if ( !empty( $list_args['exclude'] ) ) {
                $list_args['exclude'] .= ',';
            } else {
                $list_args['exclude'] = '';
            }
            $list_args['exclude'] .= get_option('page_on_front');
        }
    }

    $list_args['echo'] = false;
    $list_args['title_li'] = '';
    $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

    if ( $menu )
        $menu = '<ul class="nav '.esc_attr($args['menu_class']).'">' . $menu . '</ul>';
    $menu = apply_filters( 'wp_page_menu', $menu, $args );
    if ( $args['echo'] )
        echo $menu;
    else
        return $menu;
}
}

add_filter('wp_nav_menu','gk_wp_nav_menu');
add_filter('wp_page_menu','gk_wp_nav_menu');
if(!function_exists('gk_wp_nav_menu')){
    function gk_wp_nav_menu($menu='',$args=''){
            return str_replace('current_page_item', 'active', $menu);//替换当前选择菜单的class名称
    }
}
//评论
if(!function_exists('gk_comments')){
function gk_comments($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    include get_gk_file('comment-list.php');
}
}
