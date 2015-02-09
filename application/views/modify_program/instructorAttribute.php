<?php
$organizationId = $this->input->get("organization_id");
//Organization organization = OrganizationManager.instance().getOrganizationById(Integer.parseInt(organizationId));
$organization = $this->organization_model->getOrganizationById(intval($organizationId));
?>
<script type="text/javascript">
	$(document).ready(function() 
		{
			$(".error").hide();
		});
</script>
<form name="newForm" id="newForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="InstructorAttribute"/>
	<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId;?>"/>
	<div class="formElement">
		<div class="label">Attribute name:</div>
		<div class="field">
			 <input type="text" size="60" maxlength="100" name="name" id="name" value=""/>
		</div>
		<div class="error" id="nameMessage"></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div class="formElement">
		<div class="label"><input type="button" name="saveButton" id="saveButton" value="Add Instructor Attribute" 
			onclick="saveProgram(new Array('name'),new Array('name','organization_id'),'InstructorAttribute');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
	<hr/>
	<div id="newOutcomeDiv" class="fake-input" style="display:none;"></div> 
</form>

		
