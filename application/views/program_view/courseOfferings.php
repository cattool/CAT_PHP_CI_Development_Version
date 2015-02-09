<?php
$courseId = $this->input->get("course_id");
$programId = $this->input->get("program_id");
$this->session->set_userdata('programId',$programId);

//CourseManager cm = CourseManager.instance();
$course = $this->course_model->getCourseById(intval($courseId));
//@SuppressWarnings("unchecked")
//HashMap<String,CourseOffering> userHasAccessToOfferings = (HashMap<String,CourseOffering>)session.getAttribute("userHasAccessToOfferings");

$organization = $this->program_model->getOrganizationByProgramId($programId);
$organization_data = $organization->row();
$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();



$offerings = $this->course_model->getCourseOfferingsForCourse($courseId);
$offerings_data = $offerings->result();
$offerings_count = $offerings->num_rows();
$terms = $this->course_model->getAvailableTermsForCourse($courseId);
$terms_data = $terms->result();
$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;

$hasInstructorAttributes = false;

if($this->common->isValid($programId))
{
	$organization = $this->program_model->getOrganizationByProgramId($programId);	
	$organization_data = $organization->row();
	
	$attributes = $this->organization_model->getInstructorAttributes($organization_data->organization_id);
	$attributes_count = $attributes->num_rows();
	$hasInstructorAttributes = intval($attributes_count) < 0;

	//@SuppressWarnings("unchecked")
	//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
	//access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+organization.getId());
	$userHasAccessToOrganizationsContains = 0;
	foreach($userHasAccessToOrganizations as $org=>$key)
	{
		if($org === $organization_data->organization_id)
			$userHasAccessToOrganizationsContains = 1;
	}
	$access = $sysadmin || count($userHasAccessToOrganizations) > 0 && $userHasAccessToOrganizationsContains === 1; 
}

$regularTerm1 = "";
$regularTerm2 = "";

foreach($terms_data as $term)
{
	
	if(strlen($regularTerm1) == 0 && substr($term->term,-2) == "09")
		$regularTerm1 = $term->term;
	if(strlen($regularTerm2) == 0 && substr($term->term,-2) == "01")
		$regularTerm2 = $term->term;
		
		
	?>
	<input type="checkbox" onchange="toggleTerms('<?php echo $term->term;?>');" id="<?php echo $term->term;?>checkbox" <?php if($term->term == $regularTerm1 || $term->term == $regularTerm2){ echo "checked=\"checked\""; } ?>  /> <?php echo $term->term; ?> &nbsp; &nbsp; 
	<?php
}
?>(You can hide offerings of a term by un-checking the corresponding checkbox)
<ul>
<?php

foreach($offerings_data as $offering)
{
	$hide = (($offering->term ==  $regularTerm1 || $offering->term == $regularTerm2)?"":"style=\"display:none;\"");
	$accessToOffering = ($sysadmin || (!is_null($userHasAccessToOfferings) && $userHasAccessToOfferings == $offering->id));
	?>
	<li class="Term_<?php echo $offering->term;?>" <?php echo $hide?> >
	 <?php if($accessToOffering){?><a href="<?php echo site_url();?>/course_offering/characteristicsStart?course_offering_id=<?php echo $offering->id;?>"><?php }?>section
	 		 <?php echo $offering->section_number;?> in <?php echo $offering->term;?> ( <?php echo $offering->medium; ?> )<?php if($accessToOffering){?></a><?php }?>
	 		 <?php echo $this->course_model->getInstructorsString($offering->id,$access,$programId,$hasInstructorAttributes);?> (<?php echo $offering->num_students;?> students)
	 <?php if($access){?> 
     	<a href="javascript:loadModify('modify_program/addCourseOfferingToCourse?program_id=<?php echo $programId;?>&course_id=<?php echo $courseId;?>&course_offering_id=<?php echo $offering->id;?>');">
     		<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit course offering details" title="Edit course offering details">
        </a>
	 <?php }?>
	 <?php if($access){?> 
     	<a href="javascript:removeOfferingFromCourse(<?php echo $courseId;?>,<?php echo $offering->id;?>,<?php echo $programId?>);">
     		<img src="<?php echo base_url();?>/img/deletes.gif" style="height:10pt;" alt="Remove course offering" title="Remove course offering" >
        </a>
	 <?php } ?>
	</li>
	<?php  
}
if($offerings_count < 1)
{
	echo("No courses offerings in the system (yet).");
}
if($access)
{
?>
	<li>	<a href="javascript:loadModify('modify_program/addCourseOfferingToCourse?course_id=<?php echo $courseId;?>&program_id=<?php echo $programId;?>');" class="smaller">
				<img src="<?php echo base_url()?>img/add_24.gif" style="height:10pt;" alt="Add a course offering" title="Add a course offering"/>
				Add a course offering
			</a>
	</li>
<?php } ?>
</ul>
