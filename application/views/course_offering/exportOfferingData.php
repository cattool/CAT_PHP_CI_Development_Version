<?php
$programId = $this->session->userdata("programId");

if(!$this->common->isValid($programId))
{
	?>
	<span class="smaller">Copy data to another section of this course: unable to determine what program this offering is a part of.</span>
	<?php
	return;
}

$courseOfferingId = $this->input->get("course_offering_id");
if(isset($course_offering_id)){
	$courseOfferingId = $course_offering_id;
}
//CourseManager cm = CourseManager.instance();
$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
$courseOffering_data = $courseOffering->row();
$courseOffering_count = $courseOffering->num_rows();
$tMethods = $this->course_model->getTeachingMethods($courseOfferingId);
$tMethods_data = $tMethods->result();
$tMethods_count = $tMethods->num_rows();

if($tMethods_count < 1)
{
	?>
	<span class="smaller">Copy data to another section of this course: no data to copy.</span>
	<?php return;
}

//Course course = courseOffering.getCourse();

//@SuppressWarnings("unchecked")
$userHasAccessToOfferings = $this->session->userdata("userHasAccessToOfferings");



$offerings = $this->course_model->getCourseOfferingsWithoutDataForCourse($courseOffering_data->course_id);
$offerings_data = $offerings->result();
$offerings_count = $offerings->num_rows();
?>
<?php
if($offerings_count < 1)
{?>
   <span class="smaller">Copy data to another section of this course: no other sections to copy data to.</span>
	<?php return;
}

?>
<?php
$dummy = array();
$newArraySelect = array();
foreach($offerings_data as $selectArray){
	$dummy['id'] = $selectArray->id;
	$dummy['display'] = $selectArray->medium;
	array_push($newArraySelect, $dummy);	
}

?>
<a href="javascript:openDiv('exportDataPageDiv');" class="smaller">Copy data to another section of this course</a>
<div id="exportDataPageDiv" style="display:none;">
	<form>
    	
		Copy data to :<?php echo $this->common->createSelect("exportOfferingId", $newArraySelect, "Id","Display", null,null);?>
		<div class="formElement">
			<div class="label"><input type="button" value="Copy now" id="exportButton" onclick="exportDataFrom(<?php echo $courseOfferingId;?>,<?php echo $programId;?>)"/></div>
			<div class="field">
				<div id="messageDiv" class="completeMessage"></div>
			</div>
		</div>
	</form>
	<hr/>
</div>
