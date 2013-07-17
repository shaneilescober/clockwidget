<?php
class modelWorldClock extends Model
{
	//gets saved settings from worldclock_settings depending on the sequence
	public function getSetting($aOption)
    {
		$sSql = "SELECT * FROM worldclock_settings WHERE seq = {$aOption}";
		$data = $this->query($sSql, row);
		return $data;
    }
    //checks whether worldclock_settings table already has an existing data for the sequence specified
    public function checkdb($aOption)
    {
    	$sSql = "SELECT COUNT(*) as cSeq FROM worldclock_settings WHERE seq = ".$aOption['seq'];
    	$cData = $this->query($sSql, row);
    	return $cData;
    }
	//updates worldclock_settings data according to the sequence
    public function updateSetting($aData)
    {
    	$sSql = "UPDATE worldclock_settings 
    	SET pws_mode = 1,
    	pws_clock1_timezone = '{$aData['pg_worldclock_clock1_loc_sel']}', 
    	pws_clock2_timezone = '{$aData['pg_worldclock_clock2_loc_sel']}' 
    	WHERE 
    	seq =" .$aData['seq'];
    	
    	$bUpdate = $this->query($sSql);
    	if($bUpdate === false){
    		return false;
    	}else{
    		return true;
    	}
    }
    //inserts data into worldclock_settings depending on t he sequence specified
    public function insertSetting($aData)
    {
    	$sSql = "INSERT INTO worldclock_settings 
    	(pws_mode, 
    	seq,
    	pws_clock1_timezone, 
    	pws_clock2_timezone) 
    	VALUES 
    	(1,
    	{$aData['seq']},
    	'{$aData['pg_worldclock_clock1_loc_sel']}',
    	'{$aData['pg_worldclock_clock2_loc_sel']}')";

    	$bInsert = $this->query($sSql);
    	if($bInsert === false){
    		return false;
    	}else{
    		return true;
    	}

    }
    //deletes sequence record in database 
    function deleteContentsBySeq($aSeq)
    {
    	$sSeqs = implode(',', $aSeq);
    	$sQuery = "Delete from clockwidget_sequence where seq in($sSeqs)";
    	$mResult = $this->query($sQuery);
    	return $mResult;
    }
}