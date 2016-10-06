<?php if(empty($rules_id)) $rules_id=''; ?>
<div id="box_ajax_msg<?php echo $rules_id?>" class="alert" style="display:none;margin-bottom:7px">
	<?php if(empty($no_close)){ ?>
		<span onclick="$('.alert').hide();" class='btn btn-sm pull-right glyphicon glyphicon-remove'></span>
	<?php } ?>
	<span id="ajax_msg<?php echo $rules_id?>"></span>
</div>