<?php
$organizationId = intval($this->input->get("organization_id"));
$organization = $this->organization_model->getOrganizationById($organizationId);
$organization_data = $organization->result();

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

$access = $sysadmin;

$outcomeParameter = $this->input->get("outcome");
//OutcomeManager om = OutcomeManager.instance();
$outcome = "";
if($this->common->isValid($outcomeParameter))
{
	$outcome = $this->outcome_model->getOrganizationOutcomeByName($outcomeParameter);
	$outcome_data = $outcome->row();
}

$programName = "";
?>
<script type="text/javascript">
	$(document).ready(function() 
		{
			$(".error").hide();
		});
</script>
<form name="newProgramOutcomeForm" id="newProgramOutcomeForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="ProgramOutcome"/>
	<input type="hidden" name="organization_id" id="organization_id" value="<%=organizationId%>"/>
	<div class="formElement">
		<div class="label">Outcome:</div>
		<div class="field"> 
		<?php 
 			$list = $this->organization_model->getOrganizationOutcomesForOrg($organizationId);
 			$list_data = $list->result();
				//echo (HTMLTools.createSelectOrganizationOutcomes("outcomeToAdd", list, null));
				
			$templist = array();
			foreach($list_data as $tempListNew){
					$bogus = array();
					$bogus['oo_id'] = $tempListNew->oo_id;
					$bogus['oo_name'] = $tempListNew->oo_name;
					$bogus['oog_id'] = $tempListNew->oog_id;
					$bogus['oog_name'] = $tempListNew->oog_name;
					array_push($templist,$bogus);
			}
			echo($this->common->createSelectOrganizationOutcomes("outcomeToAdd", $list_data, ""));	
 		?>
 		<br/>
 		<?php if($sysadmin){ 
		
		?>
 		<a href="javascript:loadModify('modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>');" class="smaller">
        	Edit outcomes
        </a>
		<?php } ?>
		</div>
		
		<div class="error" id="subjectMessage"></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div class="formElement">
		<div class="label">
			<input type="button" name="saveButton" id="saveButton" value="Add Organization Outcome" 
						onclick="saveProgram(new Array('outcomeToAdd'),new Array('outcomeToAdd','organization_id'),'OrganizationOutcome','<?php echo base_url();?>','<?php echo $clientBrowser;?>');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div id="newOutcomeDiv" class="fake-input" style="display:none;"></div> 
</form>

		
