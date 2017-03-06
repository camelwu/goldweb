<ul class='nationality_ul'>
    <?php foreach($countryData as $cv): ?>
        <li data-value='<?php echo $cv['countryCode']?>' data-number='<?php echo $cv['phoneCode']?>'><?php echo $cv['chineseName']?></li>
    <?php endforeach; ?>
</ul>
