+(function($){
    $(document).ready(function(){
      $('.list_information .not_find_wrap').each(function(item){
                $(this).prev().find('a').hide();
        })
    })
})(jQuery);
