var PLUGIN_Worldclockfront_digital = {

	startDigital  : function()
	{
		var pNode = $("#PLUGIN_Worldclock");
		var sUrl = $('#pg_wordlclock_ajaxurl').val();

		var mData = { url : sUrl }
		PLUGIN.post(pNode, mData , 'custom' , 'json' , PLUGIN_Worldclockfront_digital.ajaxCallBackJsonGetTimeZone);
	},

	ajaxCallBackJsonGetTimeZone : function(result)
	{
		//CLOCK 1
		var timeZoneClock1=result.clock2;
		var aResultClock1 = timeZoneClock1.split(" ");

		var aDateClock1 = aResultClock1[0].split("-");
		var yrClock1 = aDateClock1[0];
		var moClock1 = aDateClock1[1];
		var dayClock1 = aDateClock1[2]; 

		var aTimeClock1 = aResultClock1[1].split(":");
		var hourClock1 = aTimeClock1[0];
		var minClock1 = aTimeClock1[1];
		var secClock1 = aTimeClock1[2];

		//get current time/date from local computer
		var nowClock1 = new Date(yrClock1,moClock1,dayClock1,hourClock1,minClock1,secClock1);
		var currentHoursClock1 = nowClock1.getHours( );
		var currentMinutesClock1 = nowClock1.getMinutes( );
		var currentSecondsClock1 = nowClock1.getSeconds( );
	 
		// Pad the minutes and seconds with leading zeros, if required
		currentMinutesClock1 = ( currentMinutesClock1 < 10 ? "0" : "" ) + currentMinutesClock1;
		currentSecondsClock1 = ( currentSecondsClock1 < 10 ? "0" : "" ) + currentSecondsClock1;
	 
		// Choose either "AM" or "PM" as appropriate
		var timeOfDay = ( currentHoursClock1 < 12 ) ? "AM" : "PM";
	 
		// Convert the hours component to 12-hour format if needed
		currentHoursClock1 = ( currentHoursClock1 > 12 ) ? currentHoursClock1 - 12 : currentHoursClock1;
	 
		// Convert an hours component of "0" to "12"
		currentHoursClock1 = ( currentHoursClock1 == 0 ) ? 12 : currentHoursClock1;
	 
		// Compose the string for display
		var currentTimeStringClock1 = currentHoursClock1 + ":" + currentMinutesClock1 + ":" + currentSecondsClock1 + " " + timeOfDay;
	 
		$("#clock").html(currentTimeStringClock1);
	 
	}
}
 
$(document).ready(function()
{
	setInterval(function(){
			PLUGIN_Worldclockfront_digital.startDigital();
	}, 1000);
});