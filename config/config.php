<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
return array(
    'debug'=>true,//开启调试后，以管理员身份登录能看见调试信息
    'sidebar_debug'=>false,
    'content_width'=>630,
    //设置主题支持
    'theme_support'=>array(
        'automatic-feed-links',
        'post-thumbnails',
        'post-formats'=>array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ),
        'custom-header'=>array(
                'header-text'=>false,
                'width' => apply_filters( 'gk_header_image_width', 1000 ),
                'height' => apply_filters( 'gk_header_image_height', 288 ),
                'flex-height' => true,
                'random-default' => true
        ),
        'custom-background'=>array(
            'default-color'=>'fff'
        )
    ),
    //定义头部图片
    'register_default_headers'=>array(
        'img_1' => array(
            'url' => '%s/static/img/headers/006.jpg',
            'thumbnail_url' => '%s/static/img/headers/006_s.jpg',
            /* translators: header image description */
            'description' => __( '淡香沃土', 'gkwp' )
        ),
        'img_2' => array(
            'url' => '%s/static/img/headers/017.jpg',
            'thumbnail_url' => '%s/static/img/headers/017_s.jpg',
            /* translators: header image description */
            'description' => __( '白色飞翔', 'gkwp' )
        ),
        'img_3' => array(
            'url' => '%s/static/img/headers/024.jpg',
            'thumbnail_url' => '%s/static/img/headers/024_s.jpg',
            /* translators: header image description */
            'description' => __( '都市节奏', 'gkwp' )
        ),
        'img_4' => array(
            'url' => '%s/static/img/headers/027.jpg',
            'thumbnail_url' => '%s/static/img/headers/027_s.jpg',
            /* translators: header image description */
            'description' => __( '风雨无阻', 'gkwp' )
        ),
        'img_5' => array(
            'url' => '%s/static/img/headers/038.jpg',
            'thumbnail_url' => '%s/static/img/headers/038_s.jpg',
            /* translators: header image description */
            'description' => __( '光影殿堂', 'gkwp' )
        )
    ),
    //定义缩略图
    'thumbnails'=>array(
        //'your_name'=>array(90,90,false)
    ),
    'register_nav_menus'=>array(
        'primary'=>__('主菜单','gkwp')
    ),
    'languages'=>array(
        //'name'=>__ROOT__.'/languages'
    ),
    'register_js'=>array(
        'jquery'=>'static/js/jquery-1.8.2.min.js',
        'bootstrap'=>'static/js/bootstrap.min.js'
    ),
    //目前只会针对前台加载，后台不加载
    'register_css'=>array(
        'bootstrap'=>'static/css/bootstrap.min.css',
        'bootstrap-responsive'=>'static/css/bootstrap-responsive.min.css'
    ),
    'css'=>array(
        'bootstrap',
        //'bootstrap-responsive',
        array('lte IE 6','static/css/ie6.min.css'),
        'style.css',
        'static/css/app.css'
        ),
    'js'=>array(
        'jquery',
        'bootstrap',
        array('lt IE 9','static/js/html5.js'),
        array('lte IE 6','static/js/ie6.min.js'),
        'static/js/app.js'
    ),
    //主题选项
    'theme_options'=>array(
        'test'=>array('主题选项'),
        // 'test2'=>array('显示名称2','func'),
        // 'test3'=>'显示名称3'
    ),
    'ext_config'=>array('sidebar','widget')
);