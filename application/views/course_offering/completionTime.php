<h2>Some final questions</h2>
<br>
Please complete the following questions and click the "save responses" button to save your answers.
<br/>
<?php

$courseOfferingId = intval($this->input->get("course_offering_id"));
//CourseManager cm = CourseManager.instance();
$courseOffering = $this->course_model->getCourseOfferingById($courseOfferingId);
$courseOffering_data = $courseOffering->row();
$programId = $this->session->userdata("programId");
//OrganizationManager dm = OrganizationManager.instance();
$programIdParameter = intval($this->input->get("program_id"));


if($programIdParameter > 0)
{
	//session.setAttribute("programId",""+programIdParameter);
	$this->session->set_userdata('programId',$programIdParameter);
	$programId = $programIdParameter; 
}

echo ("Currently selected Program :");
$organizations = $this->course_model->getOrganizationForCourseOffering($courseOffering_data->course_id);
$organizations_data = $organizations->result();
$programs = array();
/*Program bogus = new Program();
bogus.setId(-1);
bogus.setName("Please select a Program");
programs.add(bogus);*/

$dummy = array();
$dummy['id'] = -1;
$dummy['value']  = "Please select a Program";
array_push($programs,$dummy);

foreach($organizations_data as $dep)
{
	$programList = $this->program_model->getProgramByOrgId($dep->organization_id);
	$programList_data = $programList->result();
	foreach($programList_data as $list){
		$dummy = array();
		$dummy['id'] = $list->id;
		$dummy['value']  = $list->name;
		array_push($programs,$dummy);
			
	}
	//programs.addAll(dm.getProgramOrderedByNameForOrganization(dep));
}


echo($this->common->createSelect("programToSet", $programs, "id", "value", $programId, "setProgramIdQuestions(".$courseOfferingId.")"));

if(!$this->common->isValid($programId))
{
	//return;
}

?>
<form>
		<input type="hidden" name="program_id" value="<?php echo $programId;?>" id="program_id" />
		<input type="hidden"  name="course_offering_id" value="<?php echo $courseOfferingId;?>" id="course_offering_id"/>	

<?php  

/*<jsp:include page="programQuestions.jsp" >
<jsp:param name="program_id" value="<%=programId%>"/>
<jsp:param name="course_offering_id" value="<%=courseOfferingId%>"/>
</jsp:include>


*/ 	
     $data['program_id'] = $programId;
	 $data['course_offering_id'] = $courseOfferingId;	
     $this->load->view('course_offering/programQuestions',$data);	

?>
</form>
