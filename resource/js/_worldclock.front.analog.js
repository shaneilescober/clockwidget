//Global variables
var secondAngleClock1 = 0;
var secondAngleClock2 = 0;
var minuteAngleClock1 = 0;
var minuteAngleClock2 = 0;
var hourAngleClock1 = 0;
var hourAngleClock2 = 0;

//fixes width of first clock
var wc_clock = {
	aClock1 : $('.pg_worldclock_1'),
	clockWidthHeight : $('.pg_worldclock_1').width()//width and height of the clock
};


//fixes width of second clock
var wc_clock2 = {
		aClock2 : $('.pg_worldclock_2'),
		clockWidthHeight2 : $('.pg_worldclock_2').width()//width and height of the clock
	};

//moves and fixes the angle of hands of the clock
var frontPageClockwidget = {

	startAnalogClock : function()
	{	
		wc_clock.aClock1.css({"height":wc_clock.clockWidthHeight +"px"});//sets the height if .js is enabled. If not, height = 0;
		wc_clock.aClock1.fadeIn();//fade it in
		
		wc_clock2.aClock2.css({"height":wc_clock2.clockWidthHeight2 +"px"});//sets the height if .js is enabled. If not, height = 0;
		wc_clock2.aClock2.fadeIn();//fade it in
		
		//call rotatehands function
		
		frontPageClockwidget.rotateHands();
	},

	rotateHands : function()
	{
		var sUrl = usbuilder.getUrl('apiGetTimezone');
		var seq = $('[name=seq]').val();
		$.ajax({
			dataType : "json",
			type : "GET",
			url : sUrl,
			data: "seq=" + seq,
			success: function(info){
				frontPageClockwidget.ajaxCallBackJsonGetTimeZone(info);
				//alert(info);
			}
		});
	},
	
	ajaxCallBackJsonGetTimeZone : function(result)
	{
		//CLOCK 1
		var timeZoneClock1=result.Data.clock1;
		var namePlace = result.Data.clock1name;
		var aResultClock1 = timeZoneClock1.split(" ");
		
		var aDateClock1 = aResultClock1[0].split("-");
		var yrClock1 = aDateClock1[0];
		var moClock1 = aDateClock1[1];
		var dayClock1 = aDateClock1[2]; 

		var aTimeClock1 = aResultClock1[1].split(":");
		var hourClock1 = aTimeClock1[0];
		var minClock1 = aTimeClock1[1];
		var secClock1 = aTimeClock1[2];
		
		var weekday1 = aResultClock1[2];
		var date = aResultClock1[3] + " " + aResultClock1[4];
		var meridiem = '';
		
		if(hourClock1 >= 1 && hourClock1 < 12){
			meridiem = 'AM';
		}else{
			meridiem = 'PM';
		}
		
		//get current time/date from local computer
		var nowClock1 = new Date(yrClock1,moClock1,dayClock1,hourClock1,minClock1,secClock1);
		
		//set the second hand
		secondAngleClock1 = 360/60 * (nowClock1.getSeconds());//turn the time into angle
		$('.secondHand1').rotate(secondAngleClock1, 'abs');//set the hand angle
		$('.secondHand1').css( { "left": (wc_clock.clockWidthHeight - $('.secondHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.secondHand1').height())/2 + "px" });//set x and y pos
		
		//set the minute hand
		minuteAngleClock1 = 360/60 * (nowClock1.getMinutes());//turn the time into angle
		$('.minuteHand1').rotate(minuteAngleClock1, 'abs');//set the hand angle
		$('.minuteHand1').css( { "left": (wc_clock.clockWidthHeight - $('.minuteHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.minuteHand1').height())/2 + "px" });//set x and y pos
			
		//set the hour hand
		hourAngleClock1 = 360/12 * (nowClock1.getHours());//turn the time into angle
		$('.hourHand1').rotate((hourAngleClock1 + minuteAngleClock1/12)%360, 'abs');//set the hand angle
		$('.hourHand1').css( { "left": (wc_clock.clockWidthHeight - $('.hourHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.hourHand1').height())/2 + "px" });//set x and y pos
	
		//sets place and date under the clock
		$('.world_clock_01_place').html(namePlace);
		$('.world_clock_01_date').html(weekday1 + " " + "("+ meridiem +"), " + date);
		
		//CLOCK2
		var timeZoneClock2 = result.Data.clock2;
		var namePlace2 = result.Data.clock2name;
		var aResultClock2 = timeZoneClock2.split(" ");
		var aDateClock2 = aResultClock2[0].split("-");
		var yrClock2 = aDateClock2[0];
		var moClock2 = aDateClock2[1];
		var dayClock2 = aDateClock2[2]; 

		var aTimeClock2 = aResultClock2[1].split(":");
		var hourClock2 = aTimeClock2[0];
		var minClock2 = aTimeClock2[1];
		var secClock2 = aTimeClock2[2];
		
		var weekday2 = aResultClock2[2];
		var date2 = aResultClock2[3] + " " + aResultClock2[4];
		var meridiem2 = '';
		
		if(hourClock2 >=1 && hourClock2 < 12){
			meridiem2 = 'AM';
		}else{
			meridiem2 = 'PM';
		}
		
		//get current time/date from local computer
		var nowClock2 = new Date(yrClock2,moClock2,dayClock2,hourClock2,minClock2,secClock2);
		
		//set the second hand
		secondAngleClock2 = 360/60 * (nowClock2.getSeconds());//turn the time into angle
		$('.secondHand2').rotate(secondAngleClock2, 'abs');//set the hand angle
		$('.secondHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.secondHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.secondHand2').height())/2 + "px" });//set x and y pos
		
		//set the minute hand
		minuteAngleClock2 = 360/60 * (nowClock2.getMinutes());//turn the time into angle
		$('.minuteHand2').rotate(minuteAngleClock2, 'abs');//set the hand angle
		$('.minuteHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.minuteHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.minuteHand2').height())/2 + "px" });//set x and y pos
			
		//set the hour hand
		hourAngleClock2 = 360/12 * (nowClock2.getHours());//turn the time into angle
		$('.hourHand2').rotate((hourAngleClock2 + minuteAngleClock2/12)%360, 'abs');//set the hand angle
		$('.hourHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.hourHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.hourHand2').height())/2 + "px" });//set x and y pos
	
		//sets place and date under the clock
		$('.world_clock_02_place').html(namePlace2);
		$('.world_clock_02_date').html(weekday2 + " " + "("+ meridiem2 +"), " + date2);
		
		
	}
};

$(document).ready(function(){
	frontPageClockwidget.startAnalogClock();
	setInterval(function(){
		if(secondAngleClock1 == 360 || secondAngleClock2 == 360){
			secondAngleClock1 = 0;
			secondAngleClock2 = 0;
			secondAngleClock1 = secondAngleClock1 + 6;
			secondAngleClock2 = secondAngleClock2 + 6;
		}
		if(secondAngleClock1 > 0 || secondAngleClock2 > 0){
			secondAngleClock1 = secondAngleClock1 + 6;
			secondAngleClock2 = secondAngleClock2 + 6;
			
			$('.secondHand1').rotate(secondAngleClock1, 'abs');//set the hand angle
			$('.secondHand1').css( { "left": (wc_clock.clockWidthHeight - $('.secondHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.secondHand1').height())/2 + "px" });//set x and y pos
			$('.secondHand2').rotate(secondAngleClock2, 'abs');//set the hand angle
			$('.secondHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.secondHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.secondHand2').height())/2 + "px" });
		}
	}, 1000);
	
	setInterval(function(){
		if(minuteAngleClock1 == 360 || minuteAngleClock2 == 360){
			minuteAngleClock1 = 0;
			minuteAngleClock2 = 0;
			minuteAngleClock1 = minuteAngleClock1 + 6;
			minuteAngleClock2 = minuteAngleClock2 + 6;
		}
		if(minuteAngleClock1 > 0 || minuteAngleClock2 > 0){
			minuteAngleClock1 = minuteAngleClock1 + 6;
			minuteAngleClock2 = minuteAngleClock2 + 6;
			
			$('.minuteHand1').rotate(minuteAngleClock1, 'abs');//set the hand angle
			$('.minuteHand1').css( { "left": (wc_clock.clockWidthHeight - $('.minuteHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.minuteHand1').height())/2 + "px" });//set x and y pos
			$('.minuteHand2').rotate(minuteAngleClock2, 'abs');//set the hand angle
			$('.minuteHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.minuteHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.minuteHand2').height())/2 + "px" });//set x and y pos
		}
	}, 60000);
	
	setInterval(function(){
		if(hourAngleClock1 == 360 || hourAngleClock2 == 360){
			hourAngleClock1 = 0;
			hourAngleClock2 = 0;
			hourAngleClock1 = hourAngleClock1 + 6;
			hourAngleClock2 = hourAngleClock2 + 6;
		}
		if(hourAngleClock1 > 0 || hourAngleClock2 > 0){
			hourAngleClock1 = hourAngleClock1 + 6;
			hourAngleClock2 = hourAngleClock2 + 6;
			
			$('.hourHand1').rotate((hourAngleClock1 + minuteAngleClock1/12)%360, 'abs');//set the hand angle
			$('.hourHand1').css( { "left": (wc_clock.clockWidthHeight - $('.hourHand1').width())/2 + "px", "top":(wc_clock.clockWidthHeight - $('.hourHand1').height())/2 + "px" });//set x and y pos
			$('.hourHand2').rotate((hourAngleClock2 + minuteAngleClock2/12)%360, 'abs');//set the hand angle
			$('.hourHand2').css( { "left": (wc_clock2.clockWidthHeight2 - $('.hourHand2').width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $('.hourHand2').height())/2 + "px" });//set x and y pos
		}
	}, 720000);
});