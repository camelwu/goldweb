<?php if($user_list->success&&count($user_list->data)>0): ?>
    <div class="often_user clearfix">
        <span class="o_u_title fl">常用</span>
        <ul class="users_ul fl">
            <?php $i=0; foreach ($user_list->data as $k => $v):?>
                <li class="card_font"
                    data-index = "<?php echo $k;?>"
                    data-travellerid="<?php echo $v->traveller->travellerId ?>"
                    data-passengerType="1"
                    data-sexCode="<?php echo $v->traveller->sexCode=='Mrs'?2:1;?>"
                    data-countryCode="<?php echo $v->traveller->countryCode ?>"
                    data-dateOfBirth="<?php echo formate_date($v->traveller->dateOfBirth,$format = 'Y-m-d');?>"
                    data-firstName="<?php echo $v->traveller->firstName?>"
                    data-lastName="<?php echo $v->traveller->lastName?>"
                    data-countryName="<?php echo $v->traveller->countryName?>"
                    data-idType="<?php echo $v->listTravellerIdInfo[$i]->idType?>"
                    data-idNumber="<?php echo $v->listTravellerIdInfo[$i]->idNumber?>"
                    data-idCountry="<?php echo $v->listTravellerIdInfo[$i]->idCountry ?>"
                    data-idActivatedDate="<?php echo $v->listTravellerIdInfo[$i]->idActivatedDate?>">
                    <p class="name"><?php echo $v->listTravellerIdInfo[$i]->idNumber?></p>
                    <p class="id"><span class="fn"><?php echo $v->traveller->firstName?></span><span class="ln"><?php echo $v->traveller->lastName?></span></p>
                    <i class=""></i>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
<?php endif ?>
