!function($){
    $(document).ready(function() {
    $('.gk_upload_button').click(function() {
         var $targetfield = $(this).prev();
         window.send_to_editor = function(html) {
             imgurl = $('img',html).attr('src');
             $targetfield.val(imgurl);
             tb_remove();
        }
         tb_show('', 'media-upload.php?type=image&TB_iframe=true');
         return false;
    });

});
}(jQuery);