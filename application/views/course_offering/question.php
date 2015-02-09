<?php
if($counter == 1)
{
	function responseValue($responses , $questionId)
	{
		$responseValues = array();
		
		foreach($responses as $response)
		{
			if($response->question_id == $questionId)
			{
				//responseValues.add(response.getResponse());
				array_push($responseValues,$response->response);
			}
		}
		return $responseValues;
	}
}



$questionId = intval($question_id);
$programId = intval($program_id);
$courseOfferingId = intval($course_offering_id);
//QuestionManager qm = QuestionManager.instance();

$q = $this->question_model->getQuestionById($questionId);
$q_data = $q->row();
//$questionType = q.getQuestionType().getName(); //select, radio, checkbox or textarea
//@SuppressWarnings("unchecked")
$responses = $this->session->userdata("programQuestionResponses");
$answers = responseValue($responses, $questionId);
?>
<?php echo $q_data->display;?>
<?php

$answerText = "";

if(count($answers)>0)
	$answerText = $answers[0];
if($questionType == "select")
{
	$options = array();
	
	$ansSet = $this->question_model->getAnswerSetById($q_data->answer_set_id);
	$ansSet_data = $ansSet->result();
	
	foreach($ansSet_data as $option){
		$dummy = array();
		$dummy['value'] = $option->ansOpt_value;
		$dummy['display']  = $option->ansOpt_display;
		array_push($options,$dummy);	
	}
	//options.addAll(q.getAnswerSet().getAnswerOptions());
	
	echo ($this->common->createSelect($programId . "_" . $courseOfferingId . "_" . $questionId , $options, "value", "display", $answerText, ""));
}
else if($questionType == "textarea")
{
	
		
	?>
	<textarea id="<?php echo $programId;?>_<?php echo $courseOfferingId;?>_<?php echo $questionId?>" name="<?php echo $programId?>_<?php echo $courseOfferingId;?>_<?php echo $questionId;?>" cols="40" rows="6"><?php echo $answerText;?></textarea>
	<?php
}
else
{



	/*<div style="padding-left:40px;">
		<jsp:include page="answerSet.jsp">
			<jsp:param name="answer_set_id" value="<%=q.getAnswerSet().getId()%>"/>
			<jsp:param name="question_type" value="<%=questionType %>"/>
			<jsp:param name="question_id" value="<%=q.getId()%>"/>
			<jsp:param name="program_id" value="<%=programId%>"/>
			<jsp:param name="course_offering_id" value="<%=courseOfferingId%>"/>	
		</jsp:include>
	</div>*/
	 $data['answer_set_id'] = $q_data->answer_set_id;
	 $data['question_type'] = $questionType;
	 $data['question_id'] = $q_data->id;
	 $data['course_offering_id'] = $courseOfferingId;
	 $data['program_id'] = $programId;	
     $this->load->view('course_offering/answerSet',$data);

}

?>
	
