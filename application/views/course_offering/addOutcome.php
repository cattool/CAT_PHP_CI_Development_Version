<?php
$courseOfferingId = $this->input->get("course_offering_id");
$organizationId = $this->input->get("organization_id");
$outcomeId = intval($this->input->get("outcome_id"));
//OutcomeManager om = OutcomeManager.instance();


$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
$courseOffering_data = $courseOffering->row();
$organization = $this->organization_model->getOrganizationById(intval($organizationId));
$organization_data = $organization->row();
$organizationName = "";
$outcomeParameter = $this->input->get("outcome");
$outcome = null;
$editing = false;
if($outcomeId >= 0)
{
	$outcome = $this->outcome_model->getOutcomeById($outcomeId);
	$outcome_data = $outcome->row();
	$editing = true;
}
else if($this->common->isValid($outcomeParameter))
{
	$outcome = $this->outcome_model->getCourseOutcomeByName($outcomeParameter);
	$outcome_data = $outcome->row();
}
$maxFieldSize= 400;//(CourseOutcome.class.getMethod("getName")).getAnnotation(Length.class).max();

?>
<hr/>
<p>
Type in one course learning outcome then click save. Return to this add outcome window to enter additional outcomes. Each entry may contain no more than <?php echo maxFieldSize?> characters (less than 10 outcomes recommended).
</p>
<form name="newCourseOfferingOutcomeForm" id="newCourseOfferingOutcomeForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="CourseOfferingOutcome"/>
	<input type="hidden" name="course_offering_id" id="course_offering_id" value="<?php echo $courseOfferingId;?>"/>
	<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId;?>"/>
	<div class="formElement">
		<div class="label">Outcome:<br/>By the end of this course, students are expected to:</div>
		<div class="field"><textarea cols="60" rows="5" id="outcomeToAdd" name="outcomeToAdd" ><?php echo $editing?$outcome_data->name:""?></textarea></div>
		<div class="error" id="outcomeToAddMessage"></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<?php if($editing){
	?>
	<input type="hidden" name="outcome_id" id="outcome_id" value="<?php echo $outcomeId?>"/>
	
	<?php }
	
	$parameterString = "";
	$charTypes = $this->organization_model->getCharacteristicTypes($organizationId);
	$charTypes_data = $charTypes->result();
	$charTypes_count = $charTypes->num_rows();
	$outcomeCharacteristics = array();

	if($editing)
	{
		$outcomeCharacteristics = $this->outcome_model->getCharacteristicsForCourseOfferingOutcome($courseOffering_data->id,$outcomeId, $organizationId);
		$outcomeCharacteristics_data = $outcomeCharacteristics->result();
	}
	
	for($i=0; $i< $charTypes_count ; $i++)
	{
		$temp = $charTypes_data[$i];
		$selectedId = -1;
		foreach($outcomeCharacteristics_data as $charac)
		{
			if($charac->Characteristic_type_id == $temp->id)
				$selectedId = $charac->id;
		}
		
			/*
			<jsp:include page="/auth/courseOffering/characteristicType.jsp">
				<jsp:param name="selectedId" value="<?php echo selectedId?>" />
				<jsp:param name="charTypeId" value="<?php echo temp.getId()?>"/>
				<jsp:param name="index" value="<?php echo i?>"/>
			</jsp:include>
			*/
			
			$data['selectedId'] = $selectedId;
			$data['charTypeId'] = $temp->characteristic_type_id;
			$data['index'] = $i;
			$this->load->view('course_offering/characteristicType',$data);		
		  
		$parameterString .= ",'characteristic_".$i."','characteristic_type_".$i."'";
	}
	

	?>
	
	<input type="hidden" name="char_count" id="char_count" value="<?php echo $charTypes_count;?>"/>
		<div class="formElement">
		<div class="label">
			<input type="button" 
				   name="saveCourseOfferingOutcomeButton" 
				   id="saveCourseOfferingOutcomeButton" 
				   value="Save" 
				   onclick="saveOffering(new Array('outcomeToAdd'),
				   				new Array('outcomeToAdd'<?php echo $parameterString?>,'organization_id','course_offering_id','char_count','outcome_id'),'CourseOfferingOutcome');" />
		</div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
</form>
