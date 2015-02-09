<?php
//Program o = new Program();
$id = $this->input->get("program_id");
$organizationId = $this->input->get("organization_id");
$organizationName="";


if(strlen($id) > 0)
{
	
	$o = $this->program_model->getProgramById(intval($id));
	$o_data = $o->row();
	$organizationName = $this->program_model->getOrganizationByProgram($o_data->name);
	$organizationName_data = $organizationName->row();
	
}
else if(strlen($organizationId) > 0)
{
	
	$org = $this->organization_model->getOrganizationById(intval($organizationId));
	$org_data = $org->row();
	$organizationName = $org_data->name;	
	
}


?>
<script type="text/javascript">
$(document).ready(function() 
{
	$(".error").hide();
});
</script>

<h4><?php if($o_data->id > 0){ echo "Modify";} else { echo "Create"; } ?> a Program (part of <?php echo $organizationName;?>) Eg. B.Sc. (Four Year) in Biology</h4>
<hr/>
<form name="newObjectForm" id="newObjectForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="Program"/>
	<?php if($o_data->id > 0)
		{
			?><input type="hidden" name="objectId" id="objectId" value="<?php echo $o_data->id;?>"/>
			<?php
		}
		else if(strlen($organizationId) > 0)
		{
			?><input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId;?>"/>
			<?php
		}
		?>
	<div class="formElement">
		<div class="label">Name:</div>
		<div class="field"> <input type="text" size="50" name="name" id="name" value="<?php if(strlen($o_data->name) >0){ echo $o_data->name;} ?>"/></div>
		<div class="error" id="nameMessage"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<!-- <div class="formElement">
		<div class="label">Description:</div>
		<div class="field"> <textarea name="description" id="description" cols="40" rows="6"><%=o.getDescription()==null?"":o.getDescription()%></textarea></div>
		<div class="spacer"> </div>
	</div> -->
	<br/>
	<div class="formElement">
		<div class="label"><input type="button" name="saveButton" id="saveButton" value="Save" onclick="saveProgram(new Array('name'),new Array('name','description','organization_id'),'Program','<?php echo base_url();?>','<?php echo $clientBrowser;?>');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
</form>

		
