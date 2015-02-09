<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modify_System extends CI_Controller {

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
		    $this->load->model(array('permission_model','login_model','organization_model','program_model','characteristics_model','assessment_model','course_model'));
		  $this->load->library('common');
		  $this->load->helper('url');
		  $this->secure->islogin($this->session->userdata('is_logged_in'));
	}
	public function index()
	{
		  clearstatcache();	
		  $data['title'] = 'Administrator - IT Inventory';
		  $this->load->view('common/header');
		  $this->load->view('modify_system/admin');
		  $this->load->view('common/footer');
	}
	
	public function editOrganization()
	{
		  $data['noBody'] = true;
		 // $this->load->view('common/header',$data);
		  $this->load->view('modify_system/editOrganization');
		  //$this->load->view('common/footer',$data);
		
	}
	
	public function saveSystem()
	{
		  $data['noBody'] = true;
		 // $this->load->view('common/header',$data);
		  $this->load->view('modify_system/saveSystem');
		  //$this->load->view('common/footer',$data);
		
	}
	
	public function organization()
	{
		 $this->load->view('organization/organization');
	}
	
	public function organizationPermissions()
	{
		 $this->load->view('modify_system/organizationPermissions');
	}
	
	public function editPermission()
	{
		 $this->load->view('modify_system/editPermission');
	}
	
	public function addPermission()
	{
		$this->load->view('modify_system/addPermission');	
	}
	
	public function systemPermissions()
	{
		$this->load->view('modify_system/systemPermissions');	
	}
	
	public function genericField()
	{
		$this->load->view('modify_system/genericField');	
	}
	
	public function test()
	{
		$this->load->view('modify_system/test');	
	}
	
	public function editCharacteristic()
	{
		$this->load->view('modify_system/editCharacteristic');	
	}
	
	public function characteristicTypeEdit()
	{
		$this->load->view('modify_system/characteristicTypeEdit');	
	}
	
	public function saveGenericField(){
		$this->load->view('modify_system/saveGenericField');	
	}
	
	public function adminCharacteristics(){
		$this->load->view('modify_system/adminCharacteristics');	
	}
	
	public function editAssessment(){
		$this->load->view('modify_system/editAssessment');	
	}
	
	public function assessmentMethodAdmin(){
		$this->load->view('modify_system/assessmentMethodAdmin');	
	}
	
	public function assessmentGroupEdit(){
		$this->load->view('modify_system/assessmentGroupEdit');	
	}
	
	public function editInstructor(){
		$this->load->view('modify_system/editInstructor');	
	}
	
	public function adminOrganization(){
		$this->load->view('modify_system/adminOrganization');	
	}
	
	public function chooseOrganization(){
		$this->load->view('modify_system/chooseOrganization');	
	}
	
	public function existingCourseSelector(){
		$this->load->view('modify_system/existingCourseSelector');	
	}
	
	public function adminInstructors(){
		$this->load->view('modify_system/adminInstructors');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */