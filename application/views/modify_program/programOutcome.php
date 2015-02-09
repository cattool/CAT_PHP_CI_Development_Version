<?php
$programId = $this->input->get("program_id");
$organizationId = intval($this->input->get("organization_id"));
//OutcomeManager om = OutcomeManager.instance();
$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();
$outcomeParameter = $this->input->get("outcome");
$outcome_data = null;

if($this->common->isValid($outcomeParameter))
{
	$outcome = $this->outcome_model->getProgramOutcomeByName($outcomeParameter);
	$outcome_data = $outcome->result();
}

$programName = "";

?>

<script type="text/javascript">
/*
	$(document).ready(function() 
		{
			$(".error").hide();
		});
*/		
</script>

<form name="newProgramOutcomeForm" id="newProgramOutcomeForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="ProgramOutcome"/>

	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId;?>"/>

    <div class="formElement">
		<div class="label">Outcome:</div>
		<div class="field"> 
		<?php
 			$list = $this->outcome_model->getProgramOutcomesForProgram($programId);
			$list_data = $list->result();
			echo($this->common->createSelectProgramOutcomes("outcomeToAdd", $list_data, !is_null($outcome)?$outcome_data->id:null));
				
 		?>
 		<br/>
 		<a href="javascript:loadModify('<?php echo site_url();?>/modify_program/editProgramOutcomes?program_id=<?php echo $programId?>&organization_id=<?php echo $organizationId?>');" class="smaller">Create/Modify Program outcomes</a>
		</div>
		
		<div class="error" id="subjectMessage"></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div class="formElement">
		<div class="label"><input type="button" name="saveProgramOutcomeButton" id="saveProgramOutcomeButton" value="Add Program Outcome" onclick="saveProgram(new Array('outcomeToAdd'),new Array('outcomeToAdd','program_id'),'ProgramOutcome');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div id="newOutcomeDiv" class="fake-input" style="display:none;"></div> 
</form>

		
