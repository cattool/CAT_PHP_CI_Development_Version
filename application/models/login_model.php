<?php
class Login_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
    /*
		checkuser if user exist for login process
		return 2 variables
	*/
    function check_user()
    {
	   $username =  mysql_real_escape_string($this->input->post('username'));
	   $password =  mysql_real_escape_string($this->input->post('password'));//md5($this->input->post('password'));
       $query = $this->db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
	   return $query;
    }
	
	function check_if_admin($username)
	{
	   $query = $this->db->query("SELECT * FROM system_admin WHERE name = '$username'");
	   return $query;	
	}

}

