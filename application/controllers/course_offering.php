<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_Offering extends CI_Controller {

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
		  $this->load->model(array('permission_model','login_model','organization_model','program_model','course_model','question_model','outcome_model','characteristics_model'));
		  $this->load->library('common','session');
		  $this->load->helper('url','string','array');
		  $this->secure->islogin($this->session->userdata('is_logged_in'));
	}
	
	public function characteristicsStart(){
		$this->load->view('common/header');
		$this->load->view('course_offering/characteristicsStart');	
		$this->load->view('common/footer');	
	}
	
	public function characteristicsWizzard(){
		$this->load->view('common/header');
		$this->load->view('course_offering/characteristicsWizzard');	
		$this->load->view('common/footer');	
	}
	
	public function characteristicsWrapper(){
		$this->load->view('common/header');
		$this->load->view('course_offering/characteristicsWrapper');	
		$this->load->view('common/footer');	
	}
	
	public function saveCourseOffering(){
		$this->load->view('course_offering/saveCourseOffering');	
	}
	
	public function organization(){
		$this->load->view('course_offering/organization');	
	}
	
	public function addOutcome(){
		$this->load->view('course_offering/addOutcome');	
	}
	
	public function outcomes(){
		$this->load->view('course_offering/outcomes');	
	}
	
	public function moveOutcome(){
		$this->load->view('course_offering/moveOutcome');	
	}
	
	public function addOrganizationCharacteristic(){
		$this->load->view('course_offering/addOrganizationCharacteristic');	
	}
	
	public function addCharacteristicToOrganization(){
		$this->load->view('course_offering/addCharacteristicToOrganization');	
	}
	
	public function outcomesMapping(){
		$this->load->view('course_offering/outcomesMapping');	
	}
	
	public function removeCourseOutcome(){
		$this->load->view('course_offering/removeCourseOutcome');	
	}
	
	public function moveCharacteristicType(){
		$this->load->view('course_offering/moveCharacteristicType');	
	}
	
	public function organizationCharacteristics(){
		$this->load->view('course_offering/organizationCharacteristics');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */