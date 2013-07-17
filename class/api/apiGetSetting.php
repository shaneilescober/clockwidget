<?php 
class apiGetSetting extends Controller_Api
{
	protected function get($aArgs)
	{
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		
		//gets the settings saved in database
		$data = common()->modelContents()->getSetting($aArgs['dSeq']);
		return $data;
	}
}