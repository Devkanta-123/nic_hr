<?php
namespace app\misc;
class MSC{
	public static function getMSC(){
		$today = date("d");
		$msc=md5($today);
		return $msc;
	}
	public static function isValidMSC($msc){
		$today = date("d");
		$mk=md5($today);
		return ($mk==$msc);
	}

	public static function convertBoolean($val){
		if( $val== 'true')
			return true;
		elseif( $val== 'false')
			return false;
		else
			return null;
	}
}
?>
