<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin page</title>
	
</head>

<body>	
	<!-- message box -->			
	<div id="sdk_message_box"></div>
	<p class="require"><span class="neccesary">*</span> Required</p>
	<!-- input area -->			
	<form id="pg_worldclock_setting_form" name = "pg_worldclock_setting_form" method="POST">
	<input type="hidden" name="return_url" value="<?php echo $sUrl; ?>" />
	<input type="hidden" name="seq" id="seq" value="<?php echo $seq; ?>" />
	<table border="1" cellspacing="0" class="table_input_vr">
		<colgroup>
			<col width="115px" />
			<col width="*" />
		</colgroup>
		<tr>
			<th><label for="clock_location1">Clock #1 Location</label></th>
			<td>
				<div class="content">
					<span class="neccesary">*</span>							
					<select name="pg_worldclock_clock1_loc_sel" id="pg_worldclock_clock1_loc_sel">
						<?php foreach($aTimeZone as $tz){ ?>
						<optgroup label="<?php echo $tz['group']; ?>">
							<?php foreach($tz['location'] as $k => $v){?>
							<option value="<?php echo $v; ?>"><?php echo $k; ?></option>
							<?php } ?>
						</optgroup>
						<?php } ?>
					</select>		
				</div>
			</td>
		</tr>
		<tr>
			<th><label for="clock_location2">Clock #2 Location</label></th>
			<td>
				<div class="content">			
					<span class="neccesary">*</span>				
					<select name="pg_worldclock_clock2_loc_sel" id="pg_worldclock_clock2_loc_sel">
						<?php foreach($aTimeZone as $tz){ ?>
						<optgroup label="<?php echo $tz['group']; ?>">
							<?php foreach($tz['location'] as $k => $v){ ?>
							<option value="<?php echo $v; ?>"><?php echo $k; ?></option>
							<?php } ?>
						</optgroup>
						<?php } ?>
					</select>
				</div>
			</td>
		</tr>
	</table>
	<div class="tbl_lb_wide_btn">
		<a href="#" class="btn_apply" title="Save changes" id="pg_worldclock_submit_btn" onclick="PLUGIN_Worldclock.submit();">Save</a>
		<a href="#" class="add_link" title="Reset to default" onclick="PLUGIN_Worldclock.reset();">Reset to Default</a>
		<?php if ($bExtensionView === 1){ ?>
            <?php echo '<a href="/admin/sub/?module=ExtensionPageManage&code=' . ucfirst(APP_ID) . '&etype=MODULE" class="add_link" title="Return to Manage Clock Widget">Return to Manage Clock Widget</a>
            <a href="/admin/sub/?module=ExtensionPageMyextensions" class="add_link" title="Return to My Extensions">Return to My Extensions</a>'; ?>
        <?php } ?>
		
	</div>
	</form>
</body>
</html>
