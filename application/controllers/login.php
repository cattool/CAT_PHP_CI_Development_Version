<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.'login
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()	
	{
		  parent::__construct();
		  $this->load->model(array('login_model'));
	}
	public function index()
	{
		
		$this->load->view('login_page');
	}
	
	public function loginprocess()
	{
	   /*			
	   $username = $this->input->post('username');
	   $password = $this->input->post('password'); //md5($this->input->post('password'));
       $query = $this->db->query("select * from tbluser myuser LEFT JOIN tblemployee emp ON myuser.iEmployeeID = emp.iEmployeeID where sUsername = '$username' and sPassword = '$password'");
	   */
	   $query = $this->login_model->check_user();
	   $bLogged = $query->num_rows();
	   
	   if($bLogged != 0)
	   {
		    $userinfo = $query->row();
			
			$data = array(
				'is_logged_in' => true,
				'username' => $userinfo->username      
				);
			$this->session->set_userdata($data); 
		   
			redirect('my_courses','location');	   
	   }else{
		    redirect('login', 'location'); 
       }
	   
	}
	
	function logout()
	{
		$data = array(
				'is_logged_in' => false,
				'username' => ''      
				);
	
		 $this->session->unset_userdata($data);
		 $this->session->sess_destroy();
	 
		 redirect('login','location');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */