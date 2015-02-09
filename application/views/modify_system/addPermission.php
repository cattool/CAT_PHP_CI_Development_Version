<?php

$programId = intval($this->input->get("program_id"));
$organizationId = intval($this->input->get("organization_id"));

if($organizationId <= 0){
	$organizationId = -1;
}
if($programId <= 0){
	$programId = -1;
}
//PermissionsManager manager = PermissionsManager.instance();
//boolean includeLdap = PermissionsManager.ldapEnabled;


?>
<script type="text/javascript">

function addPermission()
{
	if(checkRequired(new Array('userid')) )
	{
		var userid = $("#userid").val();
		var first = $("#first_name").val();
		var last = $("#last_name").val();
		modifyPermission(<?php echo $programId;?>,<?php echo $organizationId;?>,'Userid',userid,first,last,'add');
	}
	
}
			</script>
<h2>Add a Person:</h2>

<form name="newCourseOfferingForm" id="newCourseOfferingForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="ProgramAdmin"/>
	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId;?>"/>
	<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId;?>"/>
	<input type="hidden" name="type" value="Userid"/>
	<br/>

    <div class="formElement">
		<div class="label">Userid:</div>
		<div class="field"> <input type="text" size="40" name="userid" id="userid" value=""/> 
	</div>
		<div class="error" id="useridMessage"></div>
		<div class="spacer"> </div>
	</div>
			
			
	<div class="formElement">
		<div class="label">first name:</div>
		<div class="field"> <input type="text" size="50" name="first_name" id="first_name" value=""/></div>
		<div class="error" id="system_nameMessage"></div>
		<div class="spacer"> </div>
	</div>
	<div class="formElement">
		<div class="label">last name:</div>
		<div class="field"> <input type="text" size="50" name="last_name" id="last_name" value=""/></div>
		<div class="error" id="system_nameMessage"></div>
		<div class="spacer"> </div>
	</div>
			<br/>
	<div class="formElement">
		<div class="label"><input type="button" name="savePermissionButton" id="savePermissionButton" value="Add" onclick="addPermission();" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>	
			
			
			<br/>
			<br/>
			<br/>
			<div class="formElement">
	<div class="field">	
		 
	</div>
			<div class="error" id="nsidMessage"></div>
			<div class="spacer"> </div>
		</div>
	</div>
		
</form>

<div id="ldapSearchResults"></div>

