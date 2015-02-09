<?php
$bisLogin = $this->session->userdata('is_logged_in');

if($bisLogin){
	echo "You are logged in as ".$this->session->userdata('username'). " <a href='". site_url() ."/logout'>Log out</a>";
}else{
	echo '<a href="'.site_url().'/login/login" target="blank">Log in</a>';	
}

?>