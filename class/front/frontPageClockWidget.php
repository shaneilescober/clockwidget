<?php
class frontPageClockWidget extends Controller_Front
{
    protected function run($aArgs)
    {	
    	require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		 
    	$aOption['seq'] = $this->getSequence();
    	$iResultCount = common()->modelContents()->checkdb($aOption);
		
    	$aSetting = common()->modelContents()->getSetting($aOption['seq']);
    	
    	//assign values
    	if($aSetting != null) {
    		$sClock1Zone = $aSetting['pws_clock1_timezone'];
    		$sClock2Zone = $aSetting['pws_clock2_timezone'];
    	} else  {
    		$sClock1Zone = "America/Los_Angeles";
    		$sClock2Zone = "Asia/Seoul";
    	}
    	
    	//gets date of specific country
    	$sDateTime1 = new DateTime("now", new DateTimeZone($sClock1Zone));
    	$sDateTime2 = new DateTime("now", new DateTimeZone($sClock2Zone));
    	
    	$aClock1ZoneName = explode("/", $sClock1Zone);
    	$aClock2ZoneName = explode("/", $sClock2Zone);
    	$sClock1ZoneName = preg_replace('/_/', ' ', $aClock1ZoneName[1]);
    	$sClock2ZoneName = preg_replace('/_/', ' ', $aClock2ZoneName[1]);
    	
    	$date1 = $sDateTime1->format("Y-m-d H:i:s D M j Y");
    	$date2 = $sDateTime2->format("Y-m-d H:i:s D M j Y");
    	
    	$aResultClock1 = explode(" ", $date1);
    	$aTimeClock1 = explode(":", $aResultClock1[1]);
    	$hourClock1 = $aTimeClock1[0];
    	$weekday1 = $aResultClock1[2];
    	$date1 = $aResultClock1[3] . " " . $aResultClock1[4];
    	
    	if($hourClock1 >=1 && $hourClock1 < 12){
    		$meridiem1 = "AM";
    	}else{
    		$meridiem1 = "PM";
    	}
    	
    	$aResultClock2 = explode(" ", $date2);
    	$aTimeClock2 = explode(":", $aResultClock2[1]);
    	$hourClock2 = $aTimeClock2[0];
    	$weekday2 = $aResultClock2[2];
    	$date2 = $aResultClock2[3] . " " . $aResultClock2[4];
    	
    	if($hourClock2 >=1 && $hourClock2 < 12){
    		$meridiem2 = "AM";
    	}else{
    		$meridiem2 = "PM";
    	}
    	
		//assign image links to variables
		$clock1 = '
			<div class="pg_worldclock_1" style = "position:relative;width:101px !important;height:101px;margin-bottom:11px !important;display:none;">
				<img class="bg1" src="/_sdk/img/clockwidget/blue/worldclock.jpg" width="101px" height="101px" alt="clock face" style = "position:absolute;" />
				<img class="hourHand1" src="/_sdk/img/clockwidget/blue/pg_hour_hand.gif" alt="hour hand" style = "position:absolute;" />
				<img class="minuteHand1" src="/_sdk/img/clockwidget/blue/pg_min_hand.gif" alt="minute hand" style = "position:absolute;" />
				<img class="secondHand1" src="/_sdk/img/clockwidget/blue/pg_sec_hand.gif" alt="second hand" style = "position:absolute;" />
			</div>
		';
		
		$clock2 = '
			<div class="pg_worldclock_2" style = "position:relative;width:101px;height:101px;margin-bottom:11px !important;display:none;">
				<img class="bg2" src="/_sdk/img/clockwidget/blue/worldclock.jpg" width="101px" height="101px" alt="clock face" style = "position:absolute;" />
				<img class="hourHand2" src="/_sdk/img/clockwidget/blue/pg_hour_hand.gif" alt="hour hand" style = "position:absolute;" />
				<img class="minuteHand2" src="/_sdk/img/clockwidget/blue/pg_min_hand.gif" alt="minute hand" style = "position:absolute;" />
				<img class="secondHand2" src="/_sdk/img/clockwidget/blue/pg_sec_hand.gif" alt="second hand" style = "position:absolute;" />
			</div>
		';
		
		$this->assign('clock1', $clock1);
		$this->assign('clock2', $clock2);
		$this->assign("location1",$sClock1ZoneName);
		$this->assign("location2",$sClock2ZoneName);
		$this->assign("date1", $weekday1 . " " . "(". $meridiem1 ."), " . $date1);
		$this->assign("date2", $weekday2 . " " . "(". $meridiem2 ."), " . $date2);
		
		$this->writeJS('
			sdk_Module("'.usbuilder()->getModuleSelector().'").ready(function($M) {	
				var secondAngleClock1 = 0;
				var secondAngleClock2 = 0;
				var minuteAngleClock1 = 0;
				var minuteAngleClock2 = 0;
				var hourAngleClock1 = 0;
				var hourAngleClock2 = 0;
				var check = 0;
				
				var wc_clock = {
					aClock1 : $M(".pg_worldclock_1"),
					clockWidthHeight : $M(".pg_worldclock_1").width()//width and height of the clock
				};
				
				var wc_clock2 = {
					aClock2 : $M(".pg_worldclock_2"),
					clockWidthHeight2 : $M(".pg_worldclock_2").width()//width and height of the clock
				};
				
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
						var sUrl = usbuilder.getUrl("apiGetTimezone");
						var seq = '.$aOption['seq'].';
						$.ajax({
							dataType : "json",
							type : "GET",
							url : "/_sdk/api/Clockwidget/GetTimezone",
							data: "seq=" + seq,
							success: function(info){
								frontPageClockwidget.ajaxCallBackJsonGetTimeZone(info);
							}
						});
					},
					
					ajaxCallBackJsonGetTimeZone : function(result)
					{
						
						//CLOCK 1
						var timeZoneClock1=result.Data.clock1;
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
						
						//set the second hand
						secondAngleClock1 = 360/60 * (nowClock1.getSeconds());//turn the time into angle
						$M(".secondHand1").rotate(secondAngleClock1, "abs");//set the hand angle
						$M(".secondHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".secondHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".secondHand1").height())/2 + "px" });//set x and y pos
						
						//set the minute hand
						minuteAngleClock1 = 360/60 * (nowClock1.getMinutes());//turn the time into angle
						$M(".minuteHand1").rotate(minuteAngleClock1, "abs");//set the hand angle
						$M(".minuteHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".minuteHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".minuteHand1").height())/2 + "px" });//set x and y pos
							
						//set the hour hand
						hourAngleClock1 = 360/12 * (nowClock1.getHours());//turn the time into angle
						$M(".hourHand1").rotate((hourAngleClock1 + minuteAngleClock1/12)%360, "abs");//set the hand angle
						$M(".hourHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".hourHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".hourHand1").height())/2 + "px" });//set x and y pos
					
						
						//CLOCK2
						var timeZoneClock2 = result.Data.clock2;
						var aResultClock2 = timeZoneClock2.split(" ");
						var aDateClock2 = aResultClock2[0].split("-");
						var yrClock2 = aDateClock2[0];
						var moClock2 = aDateClock2[1];
						var dayClock2 = aDateClock2[2]; 
				
						var aTimeClock2 = aResultClock2[1].split(":");
						var hourClock2 = aTimeClock2[0];
						var minClock2 = aTimeClock2[1];
						var secClock2 = aTimeClock2[2];
				
						//get current time/date from local computer
						var nowClock2 = new Date(yrClock2,moClock2,dayClock2,hourClock2,minClock2,secClock2);
						
						//set the second hand
						secondAngleClock2 = 360/60 * (nowClock2.getSeconds());//turn the time into angle
						$M(".secondHand2").rotate(secondAngleClock2, "abs");//set the hand angle
						$M(".secondHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".secondHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".secondHand2").height())/2 + "px" });//set x and y pos
						
						//set the minute hand
						minuteAngleClock2 = 360/60 * (nowClock2.getMinutes());//turn the time into angle
						$M(".minuteHand2").rotate(minuteAngleClock2, "abs");//set the hand angle
						$M(".minuteHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".minuteHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".minuteHand2").height())/2 + "px" });//set x and y pos
							
						//set the hour hand
						hourAngleClock2 = 360/12 * (nowClock2.getHours());//turn the time into angle
						$M(".hourHand2").rotate((hourAngleClock2 + minuteAngleClock2/12)%360, "abs");//set the hand angle
						$M(".hourHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".hourHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".hourHand2").height())/2 + "px" });//set x and y pos
					
					}
				}
				
				
				frontPageClockwidget.startAnalogClock();
				setInterval(function(){
					if(check == 0){
    					minute();
						hour();
						check = 1;
    				}
				
					if(secondAngleClock1 == 360 || secondAngleClock2 == 360){
						secondAngleClock1 = 0;
						secondAngleClock2 = 0;
						secondAngleClock1 = secondAngleClock1 + 6;
						secondAngleClock2 = secondAngleClock2 + 6;
					}
				
					if(secondAngleClock1 > 0 || secondAngleClock2 > 0){
						secondAngleClock1 = secondAngleClock1 + 6;
						secondAngleClock2 = secondAngleClock2 + 6;
						
						$M(".secondHand1").rotate(secondAngleClock1, "abs");//set the hand angle
						$M(".secondHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".secondHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".secondHand1").height())/2 + "px" });//set x and y pos
						$M(".secondHand2").rotate(secondAngleClock2, "abs");//set the hand angle
						$M(".secondHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".secondHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".secondHand2").height())/2 + "px" });
					}
				}, 1000);
				
				setInterval(function(){
					minute();
				}, 60000);
				
				
				setInterval(function(){
					hour();
				}, 720000);
				
				function minute(){
    				if(minuteAngleClock1 == 360 || minuteAngleClock2 == 360){
						minuteAngleClock1 = 0;
						minuteAngleClock2 = 0;
						minuteAngleClock1 = minuteAngleClock1 + 6;
						minuteAngleClock2 = minuteAngleClock2 + 6;
					}
				
					if(minuteAngleClock1 > 0 || minuteAngleClock2 > 0){
						minuteAngleClock1 = minuteAngleClock1 + 6;
						minuteAngleClock2 = minuteAngleClock2 + 6;
						
						$M(".minuteHand1").rotate(minuteAngleClock1, "abs");//set the hand angle
						$M(".minuteHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".minuteHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".minuteHand1").height())/2 + "px" });//set x and y pos
						$M(".minuteHand2").rotate(minuteAngleClock2, "abs");//set the hand angle
						$M(".minuteHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".minuteHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".minuteHand2").height())/2 + "px" });//set x and y pos
					}
    			}
				
				function hour(){
    				if(hourAngleClock1 == 360 || hourAngleClock2 == 360){
						hourAngleClock1 = 0;
						hourAngleClock2 = 0;
						hourAngleClock1 = hourAngleClock1 + 6;
						hourAngleClock2 = hourAngleClock2 + 6;
					}
					if(hourAngleClock1 > 0 || hourAngleClock2 > 0){
						hourAngleClock1 = hourAngleClock1 + 6;
						hourAngleClock2 = hourAngleClock2 + 6;
						
						$M(".hourHand1").rotate((hourAngleClock1 + minuteAngleClock1/12)%360, "abs");//set the hand angle
						$M(".hourHand1").css( { "left": (wc_clock.clockWidthHeight - $M(".hourHand1").width())/2 + "px", "top":(wc_clock.clockWidthHeight - $M(".hourHand1").height())/2 + "px" });//set x and y pos
						$M(".hourHand2").rotate((hourAngleClock2 + minuteAngleClock2/12)%360, "abs");//set the hand angle
						$M(".hourHand2").css( { "left": (wc_clock2.clockWidthHeight2 - $M(".hourHand2").width())/2 + "px", "top":(wc_clock2.clockWidthHeight2 - $M(".hourHand2").height())/2 + "px" });//set x and y pos
					}
    			}
				
				jQuery.fn.rotate = function(angle,whence) {
					var p = this.get(0);
					// we store the angle inside the image tag for persistence
					if (!whence) {
						p.angle = ((p.angle==undefined?0:p.angle) + angle) % 360;
					} else {
						p.angle = angle;
					}
				
					if (p.angle >= 0) {
						var rotation = Math.PI * p.angle / 180;
					} else {
						var rotation = Math.PI * (360 + p.angle) / 180;
					}
					var costheta = Math.cos(rotation);
					var sintheta = Math.sin(rotation);
				
					if (document.all && !window.opera) {
						var canvas = document.createElement("img");
						
						canvas.src = p.src;
						canvas.height = p.height;
						canvas.width = p.width;
						canvas.style.position = "absolute";
						canvas.style.filter = "progid:DXImageTransform.Microsoft.Matrix(M11="+costheta+",M12="+(-sintheta)+",M21="+sintheta+",M22="+costheta+",SizingMethod=\"auto expand\")";
					} else {
						var canvas = document.createElement("canvas");
						if (!p.oImage) {
							canvas.oImage = new Image();
							canvas.oImage.src = p.src;
						} else {
							canvas.oImage = p.oImage;
						}
						canvas.style.width = canvas.width = Math.abs(costheta*canvas.oImage.width) + Math.abs(sintheta*canvas.oImage.height);
						canvas.style.height = canvas.height = Math.abs(costheta*canvas.oImage.height) + Math.abs(sintheta*canvas.oImage.width);
						canvas.style.position = "absolute";
						
						var context = canvas.getContext("2d");
						context.save();
						if (rotation <= Math.PI/2) {
							context.translate(sintheta*canvas.oImage.height,0);
						} else if (rotation <= Math.PI) {
							context.translate(canvas.width,-costheta*canvas.oImage.height);
						} else if (rotation <= 1.5*Math.PI) {
							context.translate(-costheta*canvas.oImage.width,canvas.height);
						} else {
							context.translate(0,-sintheta*canvas.oImage.width);
						}
						context.rotate(rotation);
						context.drawImage(canvas.oImage, 0, 0, canvas.oImage.width, canvas.oImage.height);
						context.restore();
					}
					
					canvas.className = p.className;
					canvas.angle = p.angle;
					p.parentNode.replaceChild(canvas, p);
				}
				
				jQuery.fn.rotateRight = function(angle) {
					this.rotate(angle==undefined?90:angle);
				}
				
				jQuery.fn.rotateLeft = function(angle) {
					this.rotate(angle==undefined?-90:-angle);
				}
				
			});
		');
		
    }
}
