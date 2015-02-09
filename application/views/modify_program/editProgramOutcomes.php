<?php
$linkId = intval($this->input->get("link_id"));
//OutcomeManager om = OutcomeManager.instance();
//LinkProgramProgramOutcome existing = om.getLinkProgramProgramOutcomeById(linkId);
$existing = $this->outcome_model->getLinkProgramProgramOutcomeById($linkId);
$existing_data = $existing->row();


//ProgramOutcome outcome =  existing.getProgramOutcome();
$outcome = $existing_data->program_outcome_id;
//int fieldSize= (ProgramOutcome.class.getMethod("getName")).getAnnotation(Length.class).max();
$fieldSize = 500;
$existingValue = $existing_data->name;
?>
<form name="genericFieldForm" id="genericFieldForm" method="post" action="" >
	
<input type="hidden" name="link_id" id="link_id" value="<?php echo $linkId?>"/>
	<div class="formElement">
		<div class="label">Program Outcome:</div>
		<div class="field">
			<textarea name="new_value" id="new_value" cols="40" rows="10"><?php echo $existingValue?></textarea>
		</div>
		<div class="error" id="new_valueMessage" style="padding-left:10px;"></div>
		<div class="spacer"> </div>
	</div>
	<?php 
	$organizationId = intval($this->input->get("organization_id"));
	
	$programId = intval($this->input->get("program_id"));
	//Program program = ProgramManager.instance().getProgramById(programId);
	$program = $this->program_model->getProgramById($programId);
	$program_data = $program->row();	
	$parameterString = "";
	//Organization organization = OrganizationManager.instance().getOrganizationById(organizationId);
	$organization = $this->organization_model->getOrganizationById($organizationId);
	$organization_data = $organization->row();
	//List<CharacteristicType> charTypes = organization.getCharacteristicTypes();
	$charTypes = $this->organization_model->getCharacteristicTypes($organizationId);
	$charTypes_data = $charTypes->result();
	$charTypes_count = $charTypes->num_rows();
	//List<Characteristic> outcomeCharacteristics = new ArrayList<Characteristic>();
	$outcomeCharacteristics_data = array();
	$outcomeCharacteristics = $this->outcome_model->getCharacteristicsForProgramOutcome($programId,$outcome, $organizationId);
	$outcomeCharacteristics_data = $outcomeCharacteristics->result();
	for($i=0; $i< $charTypes_count ; $i++)
	{
		//CharacteristicType temp = charTypes.get(i);
		$temp = $charTypes_data[$i];
		$selectedId = -1;
		foreach($outcomeCharacteristics_data as $charac)
		{
			if($charac->Characteristic_type_id == $temp->id)
				$selectedId = $charac->id;
		}
		
		/*
			<jsp:include page="/auth/modifyProgram/characteristicType.jsp">
				<jsp:param name="selectedId" value="<?php echo selectedId?>" />
				<jsp:param name="charTypeId" value="<?php echo temp.getId()?>"/>
				<jsp:param name="index" value="<?php echo i?>"/>
			</jsp:include>
		 */
		$data['selectedId'] = $selectedId;
		$data['charTypeId'] = $temp->id;
		$data['index'] = $i;
		$this->load->view('modify_program/characteristicType',$data);
		 
		$parameterString .= ",'characteristic_".$i."','characteristic_type_".$i."'";
	}
	?>
	<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId?>"/>
	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId?>"/>
	
	<input type="hidden" name="char_count" id="char_count" value="<?php echo $charTypes_count?>"/>
	<br/>
	<div class="formElement">
		<div class="label"><input type="button" 
				   name="saveCourseOfferingOutcomeButton" 
				   id="saveCourseOfferingOutcomeButton" 
				   value="Save" 
				   onclick="saveProgram(new Array('new_value'),
				   				new Array('link_id','new_value'<?php echo $parameterString?>,'organization_id','program_id','program_outcome_group_id','char_count','outcome_id'),'ProgramOutcomeWithCharacteristics');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>

</form>
		
