<?php

//OrganizationManager manager = OrganizationManager.instance();
$action = $this->input->get("action");

if($action == "removeType")
{
	$linkId = intval($this->input->get("link_id"));
	
	if($this->organization_model->removeAttribute($linkId))
	{
		echo("Instructor Attribute removed");
	}
	else
	{
		echo("ERROR: removing Instructor Attribute");
	}
}
else if($action == "removeValue")
{
	$linkId = $this->input->get("link_id");
	
	if($this->organization_model->removeAttributeValue(intval($linkId)))
	{
		echo("Instructor Attribute removed");
	}
	else
	{
		echo("ERROR: removing Instructor Attribute");
	}
}
?>
		
