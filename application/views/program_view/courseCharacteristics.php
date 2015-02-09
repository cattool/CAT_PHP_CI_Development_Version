<?php
$programId = $this->session->userdata('programId');//(String)session.getAttribute("programId");
$programIdParameter = intval($this->input->get("program_id"));
if($programIdParameter > -1)
{
	$this->session->set_userdata('programId',$programIdParameter);
	//session.setAttribute("programId",""+programIdParameter);
	$programId = "".$programIdParameter; 
}
//CourseManager cm = CourseManager.instance();
//OrganizationManager dm = OrganizationManager.instance();
$courseId = $this->input->get("course_id") ;
$course = $this->course_model->getCourseById(intval($courseId));
$course_data = $course->row();
$courseNumber = "".$course_data->course_number;
$subject = $course_data->subject;
//Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
//boolean sysadmin = sessionValue != null && sessionValue;
//boolean access = sysadmin;

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;


$homeOrganizations = $this->course_model->getOrganizationForCourse($course_data->id);
$homeOrganizations_data = $homeOrganizations->result();
$homeOrganization = false;
$accessToOrganizations = array();
if($this->common->isValid($programId))
{
	$program = $this->program_model->getProgramById(intval($programId));
	$program_data = $program->row();
	
	//Organization organization = program.getOrganization();
	//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization>)session.getAttribute("userHasAccessToOrganizations");
	
	$organization = $this->program_model->getOrganizationByProgramId($programId);
	$organization_data = $organization->row();
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	
	if($userHasAccessToOrganizations_count > 0)
		$userHasAccessToOrganizations = array();//new HashMap<String,Organization>();
	if($sysadmin)
	{
		$allOrgs = $this->organization_model->getAllOrganizations(false);
		$allOrgs_data = $allOrgs->result();
	
		foreach($allOrgs_data as $org)
		{			
			//userHasAccessToOrganizations.put(""+org.getId(), org);
			$userHasAccessToOrganizations[$org->id] = $org->id;

		}
		
	}
	
	$userHasAccessToOrganizationsContains = 0;
	foreach($userHasAccessToOrganizations as $org=>$key)
	{
		array_push($accessToOrganizations,$org);
		if($org === $organization_data->organization_id)
			$userHasAccessToOrganizationsContains = 1;
	}


	$access = $sysadmin || count($userHasAccessToOrganizations) > 0 && $userHasAccessToOrganizationsContains === 1; 
	foreach($homeOrganizations_data as $org)
	{
		if($org->organization_id == $organization_data->organization_id)
		{
			$homeOrganization = true;
		}
	}

}

$programs = array();
//Program bogus = new Program();
/*
bogus.setId(-1);
bogus.setName("Please select a Program");
programs.add(bogus);
*/
$userHasAccessToOrganizations[$org->id] = $org->id;
$bogus['id'] = -1;
$bogus['name'] = 'Please select a Program';
array_push($programs,$bogus);

foreach($accessToOrganizations as $dep)
{	

	$tempProgram = $this->organization_model->getProgramOrderedByNameForOrganizationLinkedToCourse($dep,$courseId);
	$tempProgram_data = $tempProgram->result();
	foreach($tempProgram_data as  $p)
	{
		$notInYet = true;
		foreach($programs as  $toCheck)
		{
			
			if($toCheck['id'] == $p->id)
			{
				$notInYet = false;
			}
		}
		if($notInYet)
		{	
			$bogus['id'] = $p->id;
			$bogus['name'] = $p->name;
			array_push($programs,$bogus);
		}
	}
	
}

echo("Currently selected Program :");
echo($this->common->createSelect("programToSet", $programs, "id", "name", $programId, "setProgramCourseContributionId(".$courseId.")"));


?>
<form><input type="button" value="Add another course" onclick="loadModifyIntoDivWithReload('modify_program/linkCourseProgram?program_id=<?php echo $programId;?>','','programCoursesDiv');" class="smaller"/>
			</form>

<?php 

$courseTitle = null;
$temp = $this->course_model->getLinkCourseProgramByCourseAndProgram(intval($programId),$course_data->id);
$temp_data = $temp->result();
$temp_count = $temp->num_rows();
$linkExists = false;
$hideOfferings = "style=\"display:none;\" ";
if($temp_count > 0)
{
	$hideOfferings = "";
}
?>

<h2>Course Information for <?php echo $subject;?> <?php echo $courseNumber;?> <?php echo $course_data->title;?>
	<?php if($access){?> 
    	<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit course details" title="Edit course details" onclick="loadModify('modify_program/course?course_id=<?php echo $course_data->id;?>&program_id=<?php echo $programId;?>');">
	<?php }?></h2>


 <?php
		    $data['course_id'] = $course_data->id;
			$data['program_id'] = $programId;
     		$this->load->view('program_view/linkProgramCourse',$data);

if($homeOrganization)
{?>

<div id="courseOfferingsDiv" <?php echo $hideOfferings;?> >
     <?php
		    $data['course_id'] = $course_data->id;
			$data['program_id'] = $programId;
     		$this->load->view('program_view/courseOfferings',$data);
	?>
     
</div>

<div id="summaryCourseOutcomes">
     <?php
     		$data['course_id'] = $course_data->id;
			$data['program_id'] = $programId;
     		$this->load->view('program_view/summaryCourseOutcomes',$data);
	?>		
</div>

<?php 
}
else
{
	

?>
	<div id="programOutcomeContributionsDiv">
    <!--
	<jsp:include page="programOutcomeContributions.jsp"> 
	 	<jsp:param name="course_id" value="<?php $course_data->id;?>"/>
	 	<jsp:param value="<?php echo $programId;?>" name="program_id"/>	
	 </jsp:include>
    --> 
     <?php
          	$data['course_id'] = $course_data->id;
			$data['program_id'] = $programId;
     		$this->load->view('program_view/programOutcomeContributions',$data);
	 ?>
</div>
<?php 
}
?>


