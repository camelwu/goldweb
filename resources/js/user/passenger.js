;(function($){
    $(document).ready(function(){
        var ajaxHandler = function(para1){
            var postObj = {travellerId:para1};
                $.ajax({
                    type:"POST",
                    url:"/user/asy_passenger_delete",
                    data: postObj,
                    async:true,
                    cache: false,
                    success: function(res){
                        if(res.success){
                            alert('删除成功!');
                            window.location.href="/user/passenger";
                        }else{
                            alert(res.message);
                        }
                    },
                    error:function(res){
                        alert('failed');
                        console.log(res)
                    }
                });
        };
        $(document.body).on('click', function(e){
            console.log(e.target.className);
           if(e.target.className == 'delete_pass'){
               console.log(222);
                          ajaxHandler($(e.target).parents('.traveller_li').eq(0).attr('data-id'), "/user/asy_passenger_delete")
           }else if(e.target.className == 'edit_pass'){
                          window.location.href="/user/passenger_add?travellerId="+$(e.target).parents('.traveller_li').eq(0).attr('data-id');
           }

        })
    })
})(jQuery);