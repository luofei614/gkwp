<?php
/**
 * Copyright (c) 2012 3g4k.com.
 * All rights reserved.
 * @package     gkwp
 * @author      luofei614 <weibo.com/luofei614>
 * @copyright   2012 3g4k.com.
 */
?>
<footer class="container mt20" role="contentinfo" id="colophon">
                                        <div class="well clearfix" id="page-footer">
                        <span class="credits alignleft">&copy; 2012 <a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>, all rights reserved.</span>                        <div id="site-generator">
                            <a rel="generator" target="_blank" title="Gkwp is a wordpress theme framework" href="http://www.3g4k.com/">Proudly powered by Gkwp</a>
                        </div>
                    </div><!-- #page-footer .well .clearfix -->
</footer>
<?php
wp_footer();
do_action('gk_show_debug');//显示调试信息
?>

</body>
</html>