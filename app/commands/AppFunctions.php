<?php

/**
 * 
 */
class AppFunctions{
	

	///------function dateparse------------------------------------------------------
	///------input  $date_ini(string)----format: 2014-14-10 10:11:30
	///------output $date_end(string)----format: 2014-14-10 10:11:30
	///-------------------------------------------------------------------------------
	///-------output   format: 2014-14-10T10:11:30
	
	public function dateparse($date_ini,$date_end)
	{
		if((isset($date_ini) && isset($date_end))&&(is_string($date_ini)&&is_string($date_end)))
		{
			$dateini=date_create($date_ini);
			$dateend=date_create($date_end);
			
			$date['date_ini']=date_format($dateini,"Y-m-d").'T'.date_format($dateini,"H:i:s");
			$date['date_end']=date_format($dateend,"Y-m-d").'T'.date_format($dateend,"H:i:s");
		}
		else {
			return false;
		}
		return $date;
	}
	
	
	
}
