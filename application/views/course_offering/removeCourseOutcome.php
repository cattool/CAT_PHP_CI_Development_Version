<?php
//OutcomeManager manager = OutcomeManager.instance();
$outcomeId = $this->input->get("outcome_id");
$courseOfferingId = $this->input->get("course_offering_id");
if($this->outcome_model->deleteCourseOfferingOutcome(intval($outcomeId), intval($courseOfferingId)))
{
	echo("CourseOffering Outcome removed");
}
else
{
	echo("ERROR: removing courseOffering outcome");
}
?>
		
