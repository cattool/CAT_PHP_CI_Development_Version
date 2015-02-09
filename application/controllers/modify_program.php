<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modify_Program extends CI_Controller {

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
		  $this->load->model(array('permission_model','login_model','organization_model','program_model','question_model','course_model','outcome_model'));
		  $this->load->library('common');
		  $this->load->helper('url','string');
		  $this->secure->islogin($this->session->userdata('is_logged_in'));
	}
	public function index()
	{
		  $data['title'] = 'Administrator - IT Inventory';
		  $this->load->view('common/header');
		  $this->load->view('program_admin/main', $data);
		  $this->load->view('common/footer');
	}
	
	public function program(){
		$this->load->view('modify_program/program');	
	}
	
	public function organizationExport(){
		$this->load->view('modify_program/organizationExports');	
	}
	
	public function saveProgram(){
		$this->load->view('modify_program/saveProgram');	
	}
	
	public function removeProgram(){
		$this->load->view('modify_program/removeProgram');	
	}
	
	public function organizationOutcome(){
		$this->load->view('modify_program/organizationOutcome');	
	}
	
	public function editOrganizationOutcomes(){
		$this->load->view('modify_program/editOrganizationOutcomes');	
	}
	
	public function linkCourseProgram(){
		$this->load->view('modify_program/linkCourseProgram');	
	}
	
	public function chooseCourse(){
		$this->load->view('modify_program/chooseCourse');	
	}
	
	public function editProgramCourseLink(){
		$this->load->view('modify_program/editProgramCourseLink');	
	}
	
	public function instructorAttribute(){
		$this->load->view('modify_program/instructorAttribute');	
	}
	
	public function editInstructorAttribute(){
		$this->load->view('modify_program/editInstructorAttribute');	
	}
	
	public function courseAttribute(){
		$this->load->view('modify_program/courseAttribute');	
	}
	
	public function editCourseAttribute(){
		$this->load->view('modify_program/editCourseAttribute');	
	}
	
	public function programOutcome(){
		$this->load->view('modify_program/programOutcome');	
	}
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */