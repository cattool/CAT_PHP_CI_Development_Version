<?php

$programId = intval($program_id);
$courseOfferingId = intval($course_offering_id);

//QuestionManager qm = QuestionManager.instance();

$o = $this->program_model->getProgramById($programId);
$o_data = $o->row();
$offering = $this->course_model->getCourseOfferingById($courseOfferingId);
$offering_data = $offering->row();

$responses = $this->question_model->getAllQuestionResponsesForProgramAndOffering($o_data->id,$courseOfferingId);
$responses_data = $responses->result();
//session.setAttribute("programQuestionResponses", responses);
$this->session->set_userdata('programQuestionResponses',$responses_data);



$questionLinks = $this->question_model->getAllQuestionsForProgram($programId);
$questionLinks_data = $questionLinks->result();
$questionLinks_count = $questionLinks->num_rows();
?>
<ol>
<?php
$clearItems = "";
$questionCount=1;
$ctr = 1;

foreach($questionLinks_data as $q)
{
	?><li id="area_<?php echo $programId;?>_<?php echo $courseOfferingId;?>_<?php echo $q->id;?>">
	<?php
	$questionType = $q->qt_name; //select, radio, checkbox or textarea
	/*
	<jsp:include page="question.jsp">
			<jsp:param name="question_id" value="<%=q.getId()%>"/>
			<jsp:param name="program_id" value="<%=programId%>"/>
			<jsp:param name="course_offering_id" value="<%=courseOfferingId%>"/>	
		</jsp:include>
	</li>
	*/
	
	 $data['question_id'] = $q->question_id;
	 $data['program_id'] = $programId;
	 $data['display'] = $q->q_display;
	 $data['course_offering_id'] = $courseOfferingId;
	 $data['counter'] = $ctr;	
	 $data['questionType'] = $questionType;
     $this->load->view('course_offering/question',$data);
	
	 
	
	$clearItems .= "$(\"#area_";
	$clearItems .= $programId;
	$clearItems .= "_";
	$clearItems .= $courseOfferingId;
	$clearItems .= "_";
	$clearItems .= $q->id;
	$clearItems .= "\").removeClass(\"completeMessage\");";
	
	$ctr++;
}
?>
</ol>
<?php 
if($questionLinks_count > 1)
	{
	?>
    
	<script type="text/javascript">
	function clearItems()
	{
		<?php echo $clearItems;?>
	}
	</script>

		<div class="formElement">
			<div class="label">
			<input type="button" 
				   name="saveCustomQuestionsButton" 
				   id="saveCustomQuestionsButton" 
				   value="Save responses" 
				   onclick="clearItems();saveOffering(new Array('program_id','course_offering_id'),
				   				new Array('course_offering_id','program_id'),'Questions');" />
			</div>
            <div class="field"><div id="messageDiv" class="completeMessage"></div></div>
            <div class="spacer"> </div>
		</div>
	
	<?php } ?>
