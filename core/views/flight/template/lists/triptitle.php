
<h4 class="fl title_fix"><?php echo $cityInfo['routeType']=='oneway'?'单程':'往返'?>航班:&nbsp;<span><?php echo $cityInfo['cityNameFrom'];?></span><span>-</span><span><?php echo $cityInfo['cityNameTo'];?></span></h4>
 <p class="fl grey trip_info_title add_line_height">
  <span class="date_value"><?php echo $cityInfo['departDate'];?></span>(
  <span><?php echo sizeof($lists->data->flightInfos);?></span>个航班,<?php if(isset($cityInfo['trainsFlightNum'])&&empty($cityInfo['directFlightNum'])):?><span><?php echo $cityInfo['trainsFlightNum'];?></span>个中转)
   <?php elseif(isset($cityInfo['directFlightNum'])&&empty($cityInfo['trainsFlightNum'])):?>
   <span><?php echo $cityInfo['directFlightNum'];?></span>个直飞)
   <?php elseif(isset($cityInfo['trainsFlightNum'])&&isset($cityInfo['directFlightNum'])):?>
   <span><?php echo $cityInfo['trainsFlightNum'];?></span>个中转, <span><?php echo $cityInfo['directFlightNum'];?></span>个直飞)
  <?php endif;?>
 </p>
