!function($){
    $(function(){
        $( '#submit' ).addClass( 'btn btn-primary btn-large' );
        $('.brand').tooltip({placement:"bottom"});
        $('#wp-calendar').addClass('table table-striped table-hover table-bordered');
        //当后台没有设置菜单，ul标签没有class属性， 加上nav的class
        $('.nav>ul').addClass('nav');
        $('.nav>ul>.current_page_item').addClass('active');
    });
}(jQuery)