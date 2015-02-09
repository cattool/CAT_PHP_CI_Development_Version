
<table>
<?php
$programId = intval($this->input->get("program_id"));
$program = $this->program_model->getProgramById($programId);
//QuestionManager qm = QuestionManager.instance();
$uneditableQuestions = $this->question_model->getAllQuestionIdsUsedInProgramsOtherThan($programId); 
$uneditableQuestions_data = $uneditableQuestions->result();
$availableQuestions = $this->question_model->getAllQuestionsNotUsedByProgram($programId);
$availableQuestions_data = $availableQuestions->result();




foreach($availableQuestions_data as $question)
{
	$containsUneditable = false;
	foreach($uneditableQuestions_data as $uneditData){
		if($question->id === $uneditData->question_id){
			$containsUneditable = true;
			break;
		}	
	}
?>
		<tr>
			<td>
				<input type="button" name="addQuestion<?php echo $question->id;?>Button" id="addQuestion<?php echo $question->id;?>Button" value="Add this question" onclick="addQuestionToProgram(<?php echo $question->id;?>,<?php echo $programId;?>);" />
			</td>
			<td>
            <?php echo $containsUneditable?"<span style=\"color:red;\">
            	Question cannot be edited or removed, as it is in use by another program
            </span><br/>":"" ?>
                <?php 
					
					$data['question_id'] = $question->id;
					$data['questionInUse'] = $containsUneditable;
					$data['editMode'] = false;
					$data['inLibrary'] = true;
				
					$this->load->view('program_view/question',$data);
					
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><hr/></td>
		</tr>
		<?php 

}
?>
</table>
<?php
function isUsedAnsSet($list, $qId)
{
	
	foreach($list as $inList)
	{
		if($inList->answer_set_id == $qId)
			return true;
	}
	
	return false;
	
}
?>
