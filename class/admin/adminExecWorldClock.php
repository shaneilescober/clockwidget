<?php
class adminExecWorldClock extends Controller_AdminExec
{
	public function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		
		//gets data from form contained $aArgs
		$aData['seq'] = $aArgs['seq'];
		$aData['pg_worldclock_clock1_loc_sel'] = $aArgs['pg_worldclock_clock1_loc_sel'];
		$aData['pg_worldclock_clock2_loc_sel'] = $aArgs['pg_worldclock_clock2_loc_sel'];
		
		//check whether database already have a record depending on the sequence
		$check = common()->modelContents()->checkdb($aData);
		
		//updates or inserts database depending on result of $check
		if($check['cSeq'] == "1"){
			$bSave = common()->modelContents()->updateSetting($aData);
		}else{
			$bSave = common()->modelContents()->insertSetting($aData);
		}
		
		//shows message whether data has been saved or not
		if($bSave === true){
			usbuilder()->message($sMessage, $sType = 'sucess');
			usbuilder()->message('Saved succesfully');
		}else{
			usbuilder()->message('Oops. Something went wrong.', 'warning');
		}
	
		//redirects to adminPageWorldClock
		usbuilder()->jsMove($aArgs['return_url']);
		//usbuilder()->vd($aArgs);
	}
}