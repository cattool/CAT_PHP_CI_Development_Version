<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organization_Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
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
		  $this->load->model(array('permission_model','login_model','organization_model','program_model'));
		  $this->load->library('common');
		  $this->load->helper('url');
		  $this->secure->islogin($this->session->userdata('is_logged_in'));
	}
	public function index()
	{
		  $data['title'] = 'Administrator - IT Inventory';
		  $this->load->view('common/header');
		  $this->load->view('program_admin/main', $data);
		  $this->load->view('common/footer');
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */