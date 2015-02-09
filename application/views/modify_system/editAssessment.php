<?php

$groupId = $this->input->get("assessment_group_id");
$assessmentId = $this->input->get("assessment_id");
$command = $this->input->get("command");
//CourseManager manager = CourseManager.instance();

if($command == ("delete") || $command == ("up") || $command == ("down"))
{
	if ($command == ("delete"))
	{	
		$existing = $this->course_model->getAssessmentsUsed(intval($assessmentId));
		$existing_count = $existing->num_rows();
		$existing_data = $existing->result();
		if(intval($existing_count) > 0)
		{
			echo "ERROR: There are courses that use this Assessment Method!  It can't be deleted at this point.";
			return;
		}
	}
	$temp  = $this->course_model->moveAssessmentMethod(intval($assessmentId),intval($groupId), $command);
	echo $temp;
	if($temp) 
	{
		echo "Assessment method processed";
	}
	else
	{
		echo "ERROR: Unable to process the " + $command;

	}
}
else if($command == "group_up" || $command == "group_down" || $command == "group_delete" )
{
	if ($command == "group_delete")
	{	
		//AssessmentGroup group = manager.getAssessmentGroupById(Integer.parseInt(groupId));
		
		//List<Assessment> children = manager.getAssessmentsForGroup(group);
		$children = $this->assessment_model->getAssessmentsForGroup($groupId);
		$children_data = $children->result();
		$children_count = $children->num_rows();
		if(intval($children_count) > 0)
		{
			echo "ERROR: There are Assessment methods that are part of this group!  It can't be deleted at this point.";
			return;
		}
	}
	
	if($this->assessment_model->moveAssessmentMethodGroup(intval($groupId), $command))
	{
		echo "Assessment method group processed";
	}
	else
	{
		echo "ERROR: Unable to process the ". $command;

	}
}
else
{		
	echo "Don't know what to do.  command \"".$command."\" not known";
}

?>
		
