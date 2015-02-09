<?php
class Secure {
	
 	public function sanitized($data)	
	{
		$datas = mysql_real_escape_string($data);
		return $datas;
	}
	
	/*
		check if its login or not
	*/
	public function islogin($is_logged_in)
	{
			if(!isset($is_logged_in) || $is_logged_in != true)		{
				redirect('login','location');	
			}	
	}
}
?>