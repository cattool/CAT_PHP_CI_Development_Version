<?php
$instructorId = intval($this->input->get("instructor_id"));

//PermissionsManager manager = PermissionsManager.instance();
//Instructor instr = new Instructor();

$instrKnown = false;
if($instructorId > -1)
{
		
	$instr = $this->permission_model->getInstructorById($instructorId);	
	$instr_data = $instr->row();
	$instrKnown = true;
}
//$includeLdap = PermissionsManager.ldapEnabled;
?>
<script type="text/javascript">
function addPermission()
{
	if(checkRequired(new Array('userid')) )
	{
		var userid = $("#userid").val();
		var first = $("#first_name").val();
		var last = $("#last_name").val();
	}
	
}
			</script>
<h2>Add/Edit Instructor:</h2>

<form name="newCourseOfferingForm" id="newCourseOfferingForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="Instructor"/>
	<input type="hidden" name="objectId" id="objectId" value="<?php echo $instructorId;?>"/>
	
	<input type="hidden" name="type" value="Userid"/>
	<br/>

    <div class="formElement">
		<div class="label">Userid:</div>
       
		<div class="field"> <input type="text" size="40" name="userid" id="userid" <?php if($instrKnown && strlen($instr_data->userid) > 0){?>disabled="disabled"<?php }?> value="<?php if($instrKnown && strlen($instr_data->userid) > 0){ echo $instr_data->userid; } ?>"/> 
		<!--<%if(PermissionsManager.ldapEnabled){ %><input type="button" value="Look up First and Last name" onClick="ldapUserLookup();"/>
		<%}%>--> 
    	</div>
		<div class="error" id="useridMessage"></div>
		<div class="spacer"> </div>
	</div>
			
			
	<div class="formElement">
		<div class="label">first name:</div>
		<div class="field"> <input type="text" size="50" name="first_name" id="first_name" value="<?php if($instrKnown &&  strlen($instr_data->first_name)>0){ echo $instr_data->first_name; }?>"/></div>
		<div class="error" id="system_nameMessage"></div>
		<div class="spacer"> </div>
	</div>
	<div class="formElement">
		<div class="label">last name:</div>
		<div class="field"> <input type="text" size="50" name="last_name" id="last_name" value="<?php if($instrKnown && strlen($instr_data->last-name)>0){ echo $instr_data->last_name; }?>"/></div>
		<div class="error" id="system_nameMessage"></div>
		<div class="spacer"> </div>
	</div>
			<br/>
	<div class="formElement">
		<div class="label"><input type="button" name="savePermissionButton" id="savePermissionButton" value="Save" onclick="saveSystem(new Array('userid','first_name','last_name'),new Array('userid','first_name','last_name'));" " /></div>
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

