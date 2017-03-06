$(function(){
    var order =  function(){
    if($(".info_direct").length>1){
        $(".info_direct:last")[0].style.border = "0px solid #fff";
    }else{
        $(".info_direct")[0].style.border = "0px solid #fff";
    }
    if($(".v_container").length>1){
         $(".v_container:last")[0].style.border = "0px solid #fff";
        console.log(111);
    }else{
        $(".v_first")[0].style.border = "0px solid #fff";
        console.log(222);
    }
    };
    order();
    //退改规则
 var warn = function(){
     $("#back").hover(function(){
        $("#Back").show();
     },function(){
         $("#Back").hide();
     });
     $("#bag").hover(function(){
         $("#Bag").show();
     },function(){
         $("#Bag").hide();
     });
 }
    warn();
});