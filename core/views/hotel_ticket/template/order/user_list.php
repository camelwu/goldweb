<?php if($user_list->success&&count($user_list->data)>0): ?>
    <div class="person_card_list">
        <p>常用</p>
        <ul class="card_ul clearfix">
            <?php $i=0; foreach ($user_list->data as $k => $v):?>
                <li class=""
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
                    <p><?php echo $v->traveller->idName?></p>
                    <p class="en_name"><?php echo $v->traveller->firstName . ' ' . $v->traveller->lastName ?></p>
                    <i></i>
                    <?php foreach ($v->listTravellerIdInfo as $info):?>
                        <id-info class="list_traveller_id_info"
                           data-id="<?=$info->id ?>"
                           data-travellerId="<?=$info->travellerId ?>"
                           data-idType="<?=$info->idType ?>"
                           data-idNumber="<?=$info->idNumber ?>"
                           data-idCountry="<?=$info->idCountry ?>"
                           data-idActivatedDate="<?=$info->idActivatedDate ?>"
                           data-nationalityCode="<?=$info->nationalityCode ?>"
                           data-idCountryName="<?=$info->idCountryName ?>"
                           data-updateTime="<?=$info->updateTime ?>"
                           data-isDelete="<?=$info->isDelete ?>"
                        ></id-info>
                    <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php else: ?>
<?php endif ?>
