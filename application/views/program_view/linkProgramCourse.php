<?php
$programId = $this->input->get("program_id") ;

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;

$organization = $this->program_model->getOrganizationByProgramId($programId);
$organization_data = $organization->row();
$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();


//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
//Organization organization = OrganizationManager.instance().getOrganizationByProgramId(programId);	
//boolean access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+organization.getId());

	$userHasAccessToOrganizationsContains = 0;
	foreach($userHasAccessToOrganizations as $org=>$key)
	{
		if($org === $organization_data->organization_id)
			$userHasAccessToOrganizationsContains = 1;
	}
	$access = $sysadmin || count($userHasAccessToOrganizations) > 0 && $userHasAccessToOrganizationsContains === 1; 

//CourseManager cm = CourseManager.instance();
//LinkCourseProgram o = new LinkCourseProgram();
$courseId = $this->input->get("course_id") ;
//Course course = new Course();
//Program p = new Program();
$course = $this->course_model->getCourseById(intval($courseId));
$course_data = $course->row();
$p = $this->program_model->getProgramById(intval($programId));
$p_data = $p->row();
$temp = $this->course_model->getLinkCourseProgramByCourseAndProgram($p_data->id,$course_data->id);
$temp_data = $temp->row();
$temp_count = $temp->num_rows();
$linkExists = false;

if($temp_count > 0){
	$linkExists = true;
	$o = $temp_data;
}

?>
<div id="editProgramCourseLinkDiv"></div>
<?php if( $linkExists)
{ ?>
<div id="programCourseLinkDiv">
	Course is <?php echo $o->cc_name;?> and is typically taken <?php echo $o->time_name;?>. 
	<?php
	if($access){?>
    	<a href="javascript:hideDiv('programCourseLinkDiv');loadURLIntoId('modify_program/editProgramCourseLink?course_id=<?php echo $courseId;?>&program_id=<?php echo $programId;?>','#editProgramCourseLinkDiv');">
        <img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit course classification" title="Edit course classification"></a> <?php } ?>
</div>
<?php 
}
else
{
?>
<script type="text/javascript">
loadURLIntoId('../modify_program/editProgramCourseLink?course_id=<?php echo $courseId;?>&program_id=<?php echo $programId;?>','#editProgramCourseLinkDiv');
</script>
<?php } ?>
