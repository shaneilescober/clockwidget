<?php
class apiGetTimezone extends Controller_Api
{
	protected function get($aArgs)
    {
    	require_once('builder/builderInterface.php');
    	usbuilder()->init($this, $aArgs);
    	
    	//gets settings from database
    	$aSetting = common()->modelContents()->getSetting($aArgs['seq']);
    	
    	//assign values
    	if($aSetting) {
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
    	
    	$aResponse = array(
    			'clock1time' => $sDateTime1->format("F j, Y H:i:s"),
    			'clock2time' => $sDateTime2->format("F j, Y H:i:s"),
    			'clock1' =>  $sDateTime1->format("Y-m-d H:i:s D M j Y"),
    			'clock2' =>  $sDateTime2->format("Y-m-d H:i:s D M j Y"),
    			'clock1name' => $sClock1ZoneName,
    			'clock2name' => $sClock2ZoneName
    	);
    	
    	return $aResponse;
    }
}