  <?php
  /**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
    if('true' === $_REQUEST['settings-updated'] ){
       echo '<div id="message" class="updated fade">保存成功!</div>';
    }
  ?>
  <div class="wrap">
  <?php screen_icon(); //显示图标  ?>
  <h2>添加数据</h2>
  <p>在这里进行数据添加.</p>
  <form action="options.php" method="post">
  <?php  
  settings_fields($option_name); 
  $options = get_option($option_name); 
  ?>
  <label for="test_input">测试数据:</label>
  <input type="text" id="test[your_option]" name="test[your_option]" value="<?php  echo esc_attr($options['your_option']); ?>"  />
  <br />
  上传文件：<?php  gk_upload('test[upload]',$options['upload']);?>
  <p>
  <input type="submit" name="submit" value="保存" />
  </p>

  </form>
  </div>