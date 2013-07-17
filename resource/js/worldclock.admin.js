var PLUGIN_Worldclock = {
	//Submit form
	submit : function()
	{
		$('#pg_worldclock_setting_form').submit();
	},
	
	//Reset tp default values
	reset : function()
	{
		$('#pg_worldclock_clock1_loc_sel').val('America/Los_Angeles');
		$('#pg_worldclock_clock2_loc_sel').val('Asia/Seoul');
		$('#template_blue').attr('checked', true);
	}
};

$(document).ready(function(){
	var seq = $('#seq').val();
	var sUrl = '';
	sUrl = usbuilder.getUrl("apiGetSetting");
	//sets the saved data to be the default data shown in the admin form
	$.ajax({
		dataType: 'json',
		type: 'GET',
		url: sUrl,
		data: "dSeq=" + seq,
		success: function(info){
			if((info.Data.pws_clock1_timezone == null) && (info.Data.pws_clock2_timezone == null)){
				$('#pg_worldclock_clock1_loc_sel').val('America/Los_Angeles');
				$('#pg_worldclock_clock2_loc_sel').val('Asia/Seoul');
			}else{
				$('#pg_worldclock_clock1_loc_sel').val(info.Data.pws_clock1_timezone);
				$('#pg_worldclock_clock2_loc_sel').val(info.Data.pws_clock2_timezone);
			}
			
			//alert(info);
		}
	});
});