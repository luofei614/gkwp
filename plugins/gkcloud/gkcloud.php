<?php
/*
Plugin Name: 主题库
Plugin URI: http://www.3g4k.com/
Description: 海量中文精选主题.
Author: luofei614
Version: 1.0
Author URI: http://www.3g4k.com/
*/
//注册菜单
add_action('admin_menu','gkcloud_menu');
function gkcloud_menu(){
    add_menu_page('主题库', '主题库', 'administrator', 'gkcloud', 'gkcloud_display','', 1000);
}

function gkcloud_display(){
    $cloud_url='http://sinaclouds.sinaapp.com/gkcloud_server/';
    if(isset($_GET['install_theme'])){
        //安装操作
        if ( ! current_user_can('install_themes') )
            wp_die(__('You do not have sufficient permissions to install themes for this site.'));
        include_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
        $skin=is_multisite()?null:new Theme_Installer_Skin();
        $upgrader = new Theme_Upgrader($skin);
        //TUDO, 主题升级安装
        $ret=$upgrader->install($cloud_url.'down.php?name='.$_GET['install_theme']);
        if(is_multisite() && $ret) echo '<br /><a href="network/themes.php">去网络管理启用主题</a>';
        return ;
    }
    $installed_themes=wp_get_themes();
    $installed=implode(',',array_keys($installed_themes));
    $middle_url=$cloud_url.'middle.php?installed='.$installed;
    //检查网络
    if(!@file_get_contents($middle_url,false,stream_context_create(array('http'=>array('timeout'=>4))))){
        wp_die('检查到你没有联网，请联网后操作!');
    }
    ?>
    <script src="<?php echo $cloud_url;?>static/js/easyXDM.min.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
    var transport = new easyXDM.Socket(
    {
        remote: "<?php echo $middle_url;?>",
        container: "embedded",
        onMessage: function (message, origin)
        {
            this.container.getElementsByTagName("iframe")[0].style.height = message+'px';
        }
    }
);
</script>
    <style>
    #embedded iframe{ width:100%; overflow: hidden; border: 0px;}
    </style>
  <div id="embedded">
</div>
    <?php
}