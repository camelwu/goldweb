<div fileuploader>
    <div class="face_img_out amtb">
        <p class="change_img"><i></i>修改头像</p>
        <div class="img_content_outer clearfix">
            <div class="img_left">
                <div class="header_img">
                    <div class="up_load_button" id="upload_avatar">上传头像</div>
                    <span class="tip_span">仅支持2M以下，格式为JPG,GIF,PNG的图片</span>
                </div>
                <div class="img_content_bg">
                    <div id="crop_target"></div>
                </div>
                <div class="button_ope">
                    <button class="cur" id="save">保存头像</button>
                    <button id="cancel" onclick="javascript:window.location.href='/user/info'">取消修改</button>
                </div>
            </div>
            <div class="img_right">
                <div class="header_img">
                    <strong class="up_load_button">效果预览</strong>
                    <span class="tip_span">在此浏览生成的头像效果</span>
                </div>
                <div class="img_zones">
                    <div id="crop_preview1" style="width:<?php echo $this->uploader->AVATAR_WIDTH; ?>px; height:<?php echo $this->uploader->AVATAR_HEIGHT; ?>px; border-radius:<?php echo $this->uploader->AVATAR_HEIGHT/2; ?>px; overflow:hidden;">
                        <img src="<?php echo $memberData[0]->bigHeadImageUrl==""?$this->config->item('resources_url')."/resources/images/header.png":$memberData[0]->bigHeadImageUrl?>">
                    </div>
                    <span class="img_size">90*90像素</span>
                </div>
                <div class="img_zones img_zones_">
                    <div id="crop_preview2" style="width:<?php echo $this->uploader->AVATAR_S_WIDTH; ?>px; height:<?php echo $this->uploader->AVATAR_S_HEIGHT; ?>px; border-radius:<?php echo $this->uploader->AVATAR_S_HEIGHT/2; ?>px; overflow:hidden;">
                        <img src="<?php echo $memberData[0]->bigHeadImageUrl==""?$this->config->item('resources_url')."/resources/images/header_60.png":$memberData[0]->smallHeadImageUrl?>">
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
</div>