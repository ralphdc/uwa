<?php /* PFA Template Cache File. Create Time:2015-06-10 02:26:13 */ ?>
<div id="scroll" class="scroll_img"> <ul> <?php if(isset($_ASI['ad']) and is_array($_ASI['ad'])) : foreach($_ASI['ad'] as $ad) : ?> <li><a href="<?php echo($_ASI['ad']['a_link']); ?>"><img alt=""
				src="<?php if(!empty($ad['a_file'])) :  ?><?php echo($ad['a_file']); ?><?php else : ?><?php echo(__APP__); ?>u/site/no_thumb.png<?php endif; ?>" /></a></li> <?php endforeach; endif; ?> </ul> </div> <div class="scroll_btn"> <a class="btn" id="backward" href="javascript:void(0)"><i
		class="icon_left"></i></a> <a class="btn" id="forward"
		href="javascript:void(0)"><i class="icon_right"></i></a> </div>