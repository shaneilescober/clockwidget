var PLUGIN_Worldclockfront_digital = {

	startDigital  : function(arr1, s1, s2)
	{
		var tzdate1 = arr1['clock1'];
		var tzdate2 = arr1['clock2'];

		//get current time/date
		var nowClock1 = new Date(tzdate1); //CLOCK1
		var nowClock2 = new Date(tzdate2); //CLOCK2

		nowClock1.setSeconds(nowClock1.getSeconds() + s1);
		nowClock2.setSeconds(nowClock2.getSeconds() + s2);

		var currentHoursClock1 = nowClock1.getHours( );
		var currentHoursClock2 = nowClock2.getHours( );

		var currentMinutesClock1 = nowClock1.getMinutes( );
		var currentMinutesClock2 = nowClock2.getMinutes( );

		var currentSecondsClock1 = nowClock1.getSeconds( );
		var currentSecondsClock2 = nowClock2.getSeconds( );

		//MONTH STRING
		var arrMonth = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

		var currentMonthClock1 = arrMonth[nowClock1.getMonth( )];
		var currentMonthClock2 = arrMonth[nowClock2.getMonth( )];

		//DATE STRING
		var currentDateClock1 = nowClock1.getDate();
		var currentDateClock2 = nowClock2.getDate();

		//DAYNAME STRING
		var arrDay = new Array("Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat");

		var currentDayClock1 = arrDay[nowClock1.getDay( )];
		var currentDayClock2 = arrDay[nowClock2.getDay( )];
	 
		// Pad the minutes and seconds with leading zeros, if required
		currentMinutesClock1 = ( currentMinutesClock1 < 10 ? "0" : "" ) + currentMinutesClock1;
		currentMinutesClock2 = ( currentMinutesClock2 < 10 ? "0" : "" ) + currentMinutesClock2;

		currentSecondsClock1 = ( currentSecondsClock1 < 10 ? "0" : "" ) + currentSecondsClock1;
		currentSecondsClock2 = ( currentSecondsClock2 < 10 ? "0" : "" ) + currentSecondsClock2;
	 
		// Choose either "AM" or "PM" as appropriate
		var timeOfDay1 = ( currentHoursClock1 < 12 ) ? "AM" : "PM";
		var timeOfDay2 = ( currentHoursClock2 < 12 ) ? "AM" : "PM";
	 
		// Convert the hours component to 12-hour format if needed
		currentHoursClock1 = ( currentHoursClock1 > 12 ) ? currentHoursClock1 - 12 : currentHoursClock1;
		currentHoursClock2 = ( currentHoursClock2 > 12 ) ? currentHoursClock2 - 12 : currentHoursClock2;
	 
		// Convert an hours component of "0" to "12"
		currentHoursClock1 = ( currentHoursClock1 == 0 ) ? 12 : currentHoursClock1;
		currentHoursClock2 = ( currentHoursClock2 == 0 ) ? 12 : currentHoursClock2;

		var location1 = arr1['loc1'];
		var location2 = arr1['loc2'];

		var dateTime1 = currentMonthClock1 + "-" + currentDateClock1 + ', ' + currentDayClock1;
		var dateTime2 = currentMonthClock2 + "-" + currentDateClock2 + ', ' + currentDayClock2;
			 
		// Compose the string for display
		var currentTimeStringClock1 = dateTime1 + ' ' + currentHoursClock1 + ":" + currentMinutesClock1 + ":" + currentSecondsClock1 + " " + timeOfDay1;
		var currentTimeStringClock2 = dateTime2 + ' ' + currentHoursClock2 + ":" + currentMinutesClock2 + ":" + currentSecondsClock2 + " " + timeOfDay2;
	 
		$("#world_digital_place1").html(location1);
		$("#world_digital_place2").html(location2);

		$("#world_digital_time1").html(currentTimeStringClock1);
		$("#world_digital_time2").html(currentTimeStringClock2);
	},
	
	getTimeZone  : function()
	{
		var pNode = $("#PLUGIN_Worldclock");
		var sUrl = $('#pg_wordlclock_ajaxurl').val();

		var mData = { url : sUrl }
		PLUGIN.post(pNode, mData , 'custom' , 'json' , PLUGIN_Worldclockfront_digital.ajaxCallBackJsonGetTZ);
	},

	ajaxCallBackJsonGetTZ : function(result)
	{
		var timeZoneClock1=result.clock1time;
		var timeZoneClock2=result.clock2time;
		var timeZoneClock1Name=result.clock1name;
		var timeZoneClock2Name=result.clock2name;

		var aParam = {
			'clock1' : timeZoneClock1,
			'clock2' : timeZoneClock2,
			'loc1' : timeZoneClock1Name,
			'loc2' : timeZoneClock2Name
		};

		var s1 = 0;
		var s2 = 0;
		setInterval(function(){
				s1++;
				s2++;
				PLUGIN_Worldclockfront_digital.startDigital(aParam, s1, s2);
		}, 1000);
	}
}
 
$(document).ready(function()
{
	PLUGIN_Worldclockfront_digital.getTimeZone();
});