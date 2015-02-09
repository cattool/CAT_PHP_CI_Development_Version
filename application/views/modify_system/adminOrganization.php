<?php
$organizationName = $this->input->post('organizationName');
$organizationKnown = false;
if(strlen($organizationName) < 0){
	$organizationKnown = true;
}
$allOrganization = $this->organization_model->getAllOrganizations(false);
$allOrganization_data = $allOrganization->result();
?>
Select a organization from the list below (to edit a organization) (or click "create new" to create a new organization)


<form name="genericFieldForm" id="genericFieldForm" method="post" action="" >
	
	<div class="formElement">
		<div class="label">Organization:</div>
		<div class="field">
        	<select id="organization" onchange="editOrganization('organization');" name="organization">
            	<option value="0">Please select a organization to edit</option>
        	<?php
				foreach($allOrganization_data as $rsallOrganization ){
						echo '<option value="'.$rsallOrganization->id.'">'.$rsallOrganization->name.'</option>';
				}
			?>
            </select>
		</div>
		<div class="error" id="new_valueMessage" style="padding-left:10px;"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<div class="formElement">
		<div class="label"><input type="button"
		           value="Create new" 
				   onclick="editOrganization();" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
	
	</form>