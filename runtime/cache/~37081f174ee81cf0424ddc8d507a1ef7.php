<?php /* PFA Template Cache File. Create Time:2015-06-06 11:59:17 */ ?>
<?php if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = htmlspecialchars($_fi['data'][$_fi['tag']]);
} ?>

<tr><td colspan="2" class="inputArea">
<div style="padding:0 0 5px">
<?php if(1 == $_fi['params']['f_save_remote']) :  ?>
	<label><input type="checkbox" value="<?php echo($_fi['tag']); ?>" name="save_remote_source[]"> <?php echo(L("SAVE_REMOTE_SOURCE")); ?></label>
<?php endif; ?>
<?php if(1 == $_fi['params']['f_watermark_remote']) :  ?>
	<label><input type="checkbox" value="<?php echo($_fi['tag']); ?>" name="watermark_remote_img[]"> <?php echo(L("WATERMARK_REMOTE_IMG")); ?></label>
<?php endif; ?>
<?php if(1 == $_fi['params']['f_get_thumb']) :  ?>
	<label><input type="checkbox" value="<?php echo($_fi['tag']); ?>" name="first_img_as_thumb[]"> <?php echo(L("FIRST_IMG_AS_THUMB")); ?></label>
<?php endif; ?>
<?php if(1 == $_fi['params']['f_get_abstract']) :  ?>
	<label><input type="checkbox" value="<?php echo($_fi['tag']); ?>" name="get_abstract[]"> <?php echo(L("GET_ABSTRACT")); ?></label>
<?php endif; ?>
<label><input type="checkbox" value="<?php echo($_fi['tag']); ?>" name="delete_external_links[]"> <?php echo(L("DELETE_EXTERNAL_LINKS")); ?></label>
<?php if(isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])) :  ?>
	<label class="fc_gry">[<?php echo(L("UWA_PAGING_TIP")); ?>]</label>
<?php endif; ?>
</div>
<?php if(isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])) :  ?>
	<textarea class="editor_paging" id="<?php echo($_fi['tag']); ?>" name="<?php echo($_fi['tag']); ?>" style="width:95%;height:240px;"><?php echo($_fi['params']['f_default']); ?></textarea>
<?php else : ?>
	<textarea class="editor" id="<?php echo($_fi['tag']); ?>" name="<?php echo($_fi['tag']); ?>" style="width:95%;height:240px;"><?php echo($_fi['params']['f_default']); ?></textarea>
<?php endif; ?>
</td></tr>
