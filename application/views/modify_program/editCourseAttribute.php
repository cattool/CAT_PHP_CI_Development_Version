<?php
//OrganizationManager manager = OrganizationManager.instance();
$action = $this->input->get("action");

if($action == "removeType")
{
	$linkId = intval($this->input->get("link_id"));
	
	if($this->organization_model->removeCourseAttribute($linkId))
	{
		echo("Course Attribute removed");
	}
	else
	{
		echo("ERROR: removing Course Attribute");
	}
}
else if($action == "removeValue")
{
	$linkId = $this->input->get("link_id");
	
	if($this->organization_model->removeCourseAttributeValue(intval($linkId)))
	{
		echo("Course Attribute removed");
	}
	else
	{
		echo("ERROR: removing Course Attribute");
	}
}
?>
		
