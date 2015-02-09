<h1><h1></h1></h1><?php
function answerIndicator($answerValues, $optionValue)
{
	if(is_null($answerValues) || empty($answerValues))
		return "";

	foreach($answerValues as $answerValue)
	{
		if(trim($answerValue) == $optionValue) 
		{
			return "checked=\"checked\"";
		}
	}
	return "";
}



$answerSetId = intval($answer_set_id);
$courseOfferingId = intval($course_offering_id);
$questionId = intval($question_id);
$programId = intval($program_id);

$questionType = $question_type;
//@SuppressWarnings("unchecked")
$responses = $this->session->userdata("programQuestionResponses");
$answers = responseValue($responses, $questionId);

//QuestionManager qm = QuestionManager.instance();

$set = $this->question_model->getAnswerSetById($answerSetId);
$set_data = $set->result();

	
	
	
//$list = set.getAnswerOptions();
foreach($set_data as $option)
{
?>
	<input type="<?php echo $questionType;?>" name="<?php echo $programId;?>_<?php echo $courseOfferingId;?>_<?php echo $questionId;?>"  value="<?php echo $option->ansOpt_value;?>"   <?php echo answerIndicator($answers,$option->ansOpt_value);?> /><?php echo $option->ansOpt_display;?><br/>
	<?php
}
?>

