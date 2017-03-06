<link type="text/css" rel="stylesheet" href="../../../../resources/css/lib/fileuploader.css"/>
<link type="text/css" rel="stylesheet" href="../../../../resources/css/lib/jquery.Jcrop.min.css" />
<script type="text/javascript" language="javascript" src="../../../../resources/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../../resources/js/lib/fileuploader.min.js"></script>
<script type="text/javascript" language="javascript" src="./../../../../resources/js/lib/jquery.Jcrop.min.js"></script>

<div class="face_img_out">
  <h3 class="change_img"><span></span>修改头像</h3>
  <div class="img_content_outer clearfix">
    <div class="img_left">
      <div class="header_img">
        <div class="up_load_button" id="upload_avatar">上传头像</div>
        <span>仅支持2M一下，格式为JPG,GIF,PNG的图片</span>
      </div>
      <div class="img_content_bg">
        <div id="crop_target"></div>
      </div>
      <div class="button_ope">
        <button class="cur" id="save">保存头像</button>
        <button id="cancel">取消修改</button>
      </div>
    </div>
    <div class="img_right">
      <div class="header_img">
        <strong class="up_load_button">效果预览</strong>
        <span>在此浏览生成的头像效果</span>
      </div>
      <div class="img_zones">
        <div id="crop_preview1" style="width:<?php echo $this->uploader->AVATAR_WIDTH; ?>px; height:<?php echo $this->uploader->AVATAR_HEIGHT; ?>px; border-radius:<?php echo $this->uploader->AVATAR_HEIGHT/2; ?>px; overflow:hidden;">
        </div>
        <span class="img_size">90*90像素</span>
      </div>
      <div class="img_zones img_zones_">
        <div id="crop_preview2" style="width:<?php echo $this->uploader->AVATAR_S_WIDTH; ?>px; height:<?php echo $this->uploader->AVATAR_S_HEIGHT; ?>px; border-radius:<?php echo $this->uploader->AVATAR_S_HEIGHT/2; ?>px; overflow:hidden;">
        </div>
        <span class="img_size">60*60像素</span>
      </div>
    </div>
  </div>
</div>
<form id="form_crop_avatar">
  <input type="hidden" name="tmp_avatar" id="crop_tmp_avatar" value="">
  <input type="hidden" name="x1" id="crop_x1" value="">
  <input type="hidden" name="y1" id="crop_y1" value="">
  <input type="hidden" name="x2" id="crop_x2" value="">
  <input type="hidden" name="y2" id="crop_y2" value="">
  <input type="hidden" name="w" id="crop_w" value="">
  <input type="hidden" name="h" id="crop_h" value="">
</form>
<script type="text/javascript">
  -(function($){
    $(document).ready(function(){
      var g_oJCrop = null,
          supportCss3 = function(style){
            var prefix = ['webkit', 'Moz', 'ms', 'o'],
                i,
                humpString = [],
                htmlStyle = document.documentElement.style,
                _toHumb = function (string) {
                  return string.replace(/-(\w)/g, function ($0, $1) {
                    return $1.toUpperCase();
                  });
                };

            for (i in prefix)
              humpString.push(_toHumb(prefix[i] + '-' + style));

            humpString.push(_toHumb(style));

            for (i in humpString)
              if (humpString[i] in htmlStyle) return true;

            return false;
          },
          updatePreview = function(c){
            if(supportCss3('border-radius')){
              $('.jcrop-handle')/*.eq(0)*/.css({
                right:Math.sqrt((3-2*Math.sqrt(2))/2)* c.w/2+'px',
                bottom:Math.sqrt((3-2*Math.sqrt(2))/2)* c.w/2+'px'
              });
            }else{
              $('.jcrop-handle')/*.eq(0)*/.css({
                right:0,
                bottom:0
              });
            }

            $('#crop_x1').val(c.x);
            $('#crop_y1').val(c.y);
            $('#crop_x2').val(c.x2);
            $('#crop_y2').val(c.y2);
            $('#crop_w').val(c.w);
            $('#crop_h').val(c.h);

            if (parseInt(c.w) > 0)
            {
              var bounds = g_oJCrop.getBounds();
              var rx1 = <?php echo $this->uploader->AVATAR_WIDTH; ?> / c.w;
              var ry1 = <?php echo $this->uploader->AVATAR_HEIGHT; ?> / c.h;
              var rx2 = <?php echo $this->uploader->AVATAR_S_WIDTH; ?> / c.w;
              var ry2 = <?php echo $this->uploader->AVATAR_S_HEIGHT; ?> / c.h;
              $('#crop_preview1 img').css({
                width: Math.round(rx1 * bounds[0]) + 'px',
                height: Math.round(ry1 * bounds[1]) + 'px',
                marginLeft: '-' + Math.round(rx1 * c.x) + 'px',
                marginTop: '-' + Math.round(ry1 * c.y) + 'px'
              });
              $('#crop_preview2 img').css({
                width: Math.round(rx2 * bounds[0]) + 'px',
                height: Math.round(ry2 * bounds[1]) + 'px',
                marginLeft: '-' + Math.round(rx2 * c.x) + 'px',
                marginTop: '-' + Math.round(ry2 * c.y) + 'px'
              });
            }
          },
          saveCropAvatar = function(){
            if($("#crop_tmp_avatar").val()=="")
            {
              alert("您还没有上传头像");
              return false;
            }

            $.ajax({
              type: "POST",
              url: "user/ajax_crop",
              data: $("#form_crop_avatar").serialize(),
              dataType: "json",
              success: function(json)
              {
                if(json.success)
                {
                  $("#crop_tmp_avatar").val("");
                  //$(".img_content_bg").eq(0).hide();
                  alert('保存成功！');
                  $("#crop_target").html('<img src="avatars/'+json.avatar+'">');
                }
                else
                {
                  alert(json.description);
                }
              }
            });
          },
          cancelCropAvatar = function(){
            if(!g_oJCrop){

            }else{
              g_oJCrop.release();
              g_oJCrop.destroy();
            }
          };
      $(function(){
        new qq.FileUploader({
          element: document.getElementById('upload_avatar'),
          action: "/user/ajax_upload_avatar",
          multiple: false,
          disableDefaultDropzone: true,
          allowedExtensions: ["<?php echo implode('", "', explode(', ',  $this->uploader->ALLOW_UPLOAD_IMAGE_TYPES) ); ?>"],
          uploadButtonText: '上传头像',
          onComplete: function(id, fileName, json) {
            if(json.success)
            {
              if(g_oJCrop!=null) g_oJCrop.destroy(); //移除选框
              $("#crop_tmp_avatar").val(json.tmp_avatar);
              $(".img_content_bg").eq(0).show();
              $(".qq-upload-list").eq(0).hide();
              $("#crop_target, #crop_preview1").html('<img src="tmp/'+json.tmp_avatar+'">');
              $("#crop_target, #crop_preview2").html('<img src="tmp/'+json.tmp_avatar+'">');
              $('#crop_target img').Jcrop({
                allowSelect: false,
                onChange: updatePreview,
                onSelect: updatePreview,
                bgColor: 'white',
                bgOpacity: 0.5,
                handleOpacity:1, //缩放按钮透明度
                createHandles:	['se'],//设置边角控制器
                aspectRatio: <?php echo $this->uploader->AVATAR_WIDTH/$this->uploader->AVATAR_HEIGHT; ?>,
                minSize:[<?php echo $this->uploader->AVATAR_WIDTH; ?>, <?php echo  $this->uploader->AVATAR_HEIGHT; ?>]
              },function(){
                g_oJCrop = this;
                var bounds = g_oJCrop.getBounds(); //获取图片实际尺寸[w,h]
                var x1,y1,x2,y2;
                if(bounds[0]/bounds[1] > <?php echo $this->uploader->AVATAR_WIDTH; ?>/<?php echo  $this->uploader->AVATAR_HEIGHT; ?>)
                {
                  y1 = 0;
                  y2 = bounds[1];

                  x1 = (bounds[0] - <?php echo $this->uploader->AVATAR_WIDTH; ?> * bounds[1]/<?php echo  $this->uploader->AVATAR_HEIGHT; ?>)/2
                  x2 = bounds[0]-x1;
                }
                else
                {
                  x1 = 0;
                  x2 = bounds[0];

                  y1 = (bounds[1] - <?php echo $this->uploader->AVATAR_HEIGHT; ?> * bounds[0]/<?php echo  $this->uploader->AVATAR_WIDTH; ?>)/2
                  y2 = bounds[1]-y1;
                }
                g_oJCrop.setSelect([x1,y1,x2,y2]); /*创建选框*/
              });
            }
            else
            {
              alert(json.description);
            }
          },
          onCancel: function(id,  fileName) {}
        });
      });
      $('#save').on('click',saveCropAvatar);
      $('#cancel').on('click',cancelCropAvatar);
    })
  })(jQuery);
</script>