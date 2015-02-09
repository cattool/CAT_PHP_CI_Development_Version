
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Program_View extends CI_Controller {

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
		  $this->load->model(array('permission_model','login_model','organization_model','program_model','course_model','outcome_model','characteristics_model','question_model'));
		  $this->load->library('common');
		  $this->load->helper('url','string','array');
		  $this->secure->islogin($this->session->userdata('is_logged_in'));
	}
	
	public function programWrapper(){
		$this->load->view('common/header');
		$this->load->view('program_view/programWrapper');	
		$this->load->view('common/footer');	
	}
	
	public function courseCharacteristicsWrapper(){
		$this->load->view('common/header');
		$this->load->view('program_view/courseCharacteristicsWrapper');	
		$this->load->view('common/footer');	
	}
	
	public function program(){
		$this->load->view('program_view/program');	
	}
	
	public function editQuestion(){
		$this->load->view('program_view/editQuestion');	
	}
	
	public function programQuestions(){
		$this->load->view('program_view/programQuestions');	
	}
	
	public function courseCharacteristics(){
		$this->load->view('program_view/courseCharacteristics');	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */