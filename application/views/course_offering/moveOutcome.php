<?php
$outcomeId = intval($this->input->get("outcome_id"));

$courseOfferingId = intval($this->input->get("course_offering_id"));
$direction = $this->input->get("direction");
$temp = $this->outcome_model->moveLinkCourseOfferingOutcome($outcomeId, $courseOfferingId,$direction);
echo $temp;
if(!$temp)
{
	echo("ERROR: Unable to move outcome ".$direction);
}

?>
		
