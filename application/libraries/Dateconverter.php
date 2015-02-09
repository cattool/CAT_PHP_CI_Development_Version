<?php
class Dateconverter {
 
 	/*
		recieve date in format mm-dd-yy
		return linuxtime stamp
	*/
   public function linuxdate($dates) {
		$date_format = explode("-",$dates);
		$converted_date = strtotime($date_format[2].'-'.$date_format[0].'-'.$date_format[1]);
		return $converted_date;
	}
	/*
		recieve value in linux timestam
		return redable date
	*/
	public function datereadable($date) {
		$dateread = date("F j, Y", $date);	
		return $dateread;
	}
	
	public function datexpiration($date_register,$months) {
		$expiration_date = date("Y-m-d",$date_register);
		$date = strtotime(date("Y-m-d", strtotime($expiration_date)) . " $months");
		$date_expiration = date("F j, Y", $date);
		return $date_expiration;
	}
	
	function count_days( $a, $b )	{
		  // First we need to break these dates into their constituent parts:
		  $gd_a = getdate( $a );
		  $gd_b = getdate( $b );
		   
		  $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
		  $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
		  return round( abs( $a_new - $b_new ) / 86400 );
  	}

}
?>