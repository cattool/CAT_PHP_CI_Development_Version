<?php
$programId = intval($this->input->get("program_id"));
$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;



$program = $this->program_model->getProgramById($programId);
$program_data = $program->row();

//String programId = request.getParameter("program_id");
//Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
//boolean sysadmin = sessionValue != null && sessionValue;
//@SuppressWarnings("unchecked")
//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
//boolean access = sysadmin;


if($this->common->isValid($programId))
{
	$organization = $this->program_model->getOrganizationByProgramId($programId);
	$organization_data = $organization->row();	
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	$access = $sysadmin || intval($userHasAccessToOrganizations_count) > 0;//$userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+organization.getId());
}

//ProgramManager pm = ProgramManager.instance();

$o = $this->program_model->getProgramById(intval($programId));
$o_data = $o->row();
//List<LinkCourseProgram> courseLinks = pm.getLinkCourseProgramForProgram(o);
$courseLinks = $this->program_model->getLinkCourseProgramForProgram($o_data->id);
$courseLinks_data = $courseLinks->result();
$courseLinks_count = $courseLinks->num_rows();
//CourseManager cm = CourseManager.instance();

?>
<ul>
<?php
if($access)
{
?>
	<li>	<a href="javascript:loadModifyIntoDivWithReload('../modify_program/linkCourseProgram?program_id=<?php echo $o_data->id;?>','','programCoursesDiv');" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add a course" title="Add a course"/>
				Add a course
			</a>
	</li>
<?php } 
$prevTime = "";



foreach($courseLinks_data as $link)
{
		
	$c = $this->course_model->getCourseForLinkProgram($link->id);
	$c_data = $c->row();
	$attributeString = $this->course_model->getCourseAttributesString($c_data->course_id, $o_data->id,$access);
	
	//CourseClassification classification = link.getCourseClassification();
	$classification = $this->course_model->getCourseClassification($link->course_classification_id);
	$classification_data = $classification->row();
	//Time time = link.getTime();
	$depts = $this->course_model->getOrganizationForCourse($c_data->course_id);
	$depts_data = $depts->result();
	$deptString = "";
	$first = true;

	
	foreach($depts_data as $dept)
	{
		if(!$first)
			$deptString.=", ";
		else
			$first = false;
			$deptString .= $dept->org_name;
	}
	
	if($prevTime != $link->t_name)
	{
		echo "Courses taken by students " . $link->t_name. ":";
	}
	?>
	<li>
    	<a href="courseCharacteristicsWrapper?program_id=<?php echo $programId;?>&course_id=<?php echo $c_data->course_id;?>&link_id=<?php echo $link->id;?>" >
    <span title="Offered by <?php echo $deptString;?>"><?php echo $c_data->c_subject;?> <?php echo $c_data->c_course_number;?></span>
			 <?php echo $c_data->c_title;?> (<?php echo $classification_data->name;?>)</a> <?php echo $attributeString;?>
	 <?php if($access){?><a href="javascript:removeProgramCourse(<?php echo $o_data->id;?>,<?php echo $link->id;?>);">
     <img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove course" title="Remove course"></a><?php } ?>
	
	</li>
	<?php 
	$prevTime= $link->t_name;
}
if($courseLinks_count < 1)
{
	echo ("No courses added (yet).");
}


?>
</ul>
