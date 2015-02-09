<form>
<?php
$programId = intval($this->input->get("program_id"));
$program = $this->program_model->getProgramById($programId);
$program_data = $program->row();
//QuestionManager qm = QuestionManager.instance();
$questionId = intval($this->input->get("question_id"));
$fieldSize= 500; //(Question.class.getMethod("getDisplay")).getAnnotation(Length.class).max();



if($questionId < 0)
{
	
	/*
	<div id="questionLibraryDiv">
		<jsp:include page="questionLibrary.jsp"/>
	</div>
	*/
	$this->load->view('program_view/questionLibrary');
	
?>
	<input type="hidden" name="list_shown" id="list_shown" value="yes"/>
	<?php
}

?><h3>Create/Edit question:</h3><br/>
<?php
$inUseString = $this->input->get("inUse");
$inUse = !is_null($inUseString) && $this->input->get("inUse");
$q = $this->question_model->getQuestionById($questionId);
$q_data = $q->row();
$editing = true;
if($questionId < 0)
	$editing = false;


$types = $this->question_model->getQuestionTypes();
$types_data = $types->result();
/*
$noType = new QuestionType();
noType.setId(-1);
noType.setDescription("Please select a question type");
noType.setName("");
types.add(0,noType);
*/
$typeTemp = array();
$bogusType = array();
$bogusType['id'] = -1;
$bogusType['description'] = "Please select question type";
$bogusType['name'] = "";
array_push($typeTemp,$bogusType);

foreach($types_data as $typeSelectData)
{
	
			$bogus = array();
			$bogus['id'] = $typeSelectData->id;
			$bogus['name'] = $typeSelectData->name;
			$bogus['description'] = $typeSelectData->description;
			array_push($typeTemp,$bogus);
	//array_push($programs,$tempProgram_data);
	//programs.addAll(dm.getProgramOrderedByNameForOrganization(dep));
}

?>


	<input type="hidden" name="answer_set_id" id="answer_set_id" value="<?php echo($editing && !is_null($q_data->answer_set_id))?$q_data->answer_set_id:"-1"; ?>" />

	<input type="hidden" name="question_id" id="question_id" value="<?php echo $editing?$q_data->id:"-1"?>" />
	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId?>" />

	<div class="formElement">
		<div class="label">Question display (<?php echo $fieldSize;?> characters max):</div>
		<div class="field"><input type="text" name="display" id="display" size="80" maxlength="<?php echo $fieldSize?>" value="<?php echo $editing?$q_data->display:""?>"/></div>
		<div class="field"><div id="displayMessage" class="completeMessage"></div></div>
		<div class="spacer"> </div>
		
	</div>
	<br/>
	
	<div class="formElement">
		<div class="label">Question type:</div>
		<div class="field"><?php echo $this->common->createSelect("question_type", $typeTemp, "name", "description", $editing?"".$q_data->qt_name:null, "setQuestionType(".$programId.");")?>
		</div>
		<div class="field"><div id="question_typeMessage" class="completeMessage"></div></div>
		<div class="spacer"> </div>
		
	</div>
	<br/>
	
	<div class="formElement">
		<div class="label">Answer set:</div>
		<div class="field">
			<div id="AnswerSetDiv">
			<?php if($editing)
			{
					$data['answer_set_id'] = !is_null($q_data->answer_set_id)?$q_data->answer_set_id:-1;
					$data['question_type'] = $q_data->qt_name;
					$data['program_id'] = $programId;
					$data['inUse'] = $inUse;
					$data['editMode'] = true;
					$this->load->view('program_view/answerSet',$data);
				
				?>
			<?php }
			else
			{
				echo("Once you have selected a question-type, you will be able to determine what the available answers will be.");
			}
			?>
			<div class="field"><div id="answer_set_idMessage" class="completeMessage"></div></div>
			</div>
		</div>
		<div class="spacer"> </div>
	</div>
	
	
	<div class="formElement">
		<div class="label"><input type="button" name="saveButton" id="saveButton" value="Save" onclick="saveProgram(new Array('display','program_id','question_type','question_id'),new Array('display','program_id','question_type','answer_set_id','question_id'),'ProgramQuestion');" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
	
	<div class="field" id="EditAnswerSetDiv">
	</div>

	
</form>

