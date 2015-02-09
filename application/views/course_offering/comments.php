<?php
$courseOfferingId = $this->input->get("course_offering_id");
//@SuppressWarnings("unchecked")
//HashMap<String,CourseOffering> userHasAccessToOfferings = (HashMap<String,CourseOffering>)session.getAttribute("userHasAccessToOfferings");

//Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
//boolean sysadmin = sessionValue != null && sessionValue;
//boolean access = sysadmin || (userHasAccessToOfferings!=null && userHasAccessToOfferings.containsKey(courseOfferingId));
//CourseOffering courseOffering = new CourseOffering();
//CourseManager cm = CourseManager.instance();
//OrganizationManager dm = OrganizationManager.instance();
//OutcomeManager om = OutcomeManager.instance();

$userHasAccessToOfferings = $this->session->userdata('userHasAccessToOfferings');
$containsKeyOffering = 0;
if(!is_null($userHasAccessToOfferings) && strlen($userHasAccessToOfferings) > 0){
	foreach($userHasAccessToOfferings as $row=>$id){
		if($row === $courseOfferingId)
			$containsKeyOffering = 1;	
	}
}

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin || !is_null($userHasAccessToOfferings) && $containsKeyOffering;



if($this->common->isValid($courseOfferingId))
{
	$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
	$courseOffering_data = $courseOffering->row();
}
?>
<h2>Additional Information</h2>
<div id="courseOfferingComments">
	<?php echo is_null($courseOffering_data->comments)?"No additional information entered. Select edit icon below to add additional information about your course.":$courseOffering_data->comments;?>
	
</div>
<br/>
<?php if($access){?>
	<a href="javascript:loadModify('course_offering/editComments?course_offering_id=<?php echo $courseOfferingId;?>','courseOfferingComments');" class="smaller">
		<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit comment" title="Edit comment">
    </a> 
<?php }?>

