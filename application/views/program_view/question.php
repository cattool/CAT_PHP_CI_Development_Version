<?php
$questionId = intval($question_id); //intval($this->input->get("question_id"));
$programId = intval($program_id); //intval($this->input->get("program_id"));
//QuestionManager qm = QuestionManager.instance();
$editModeString = $editMode; //$this->input->get("editMode");
$inUseString = $questionInUse; //$this->input->get("questionInUse");
$editMode = !is_null($editModeString) && $editMode == "true";
$inUse = !is_null($inUseString) && $questionInUse == "true";
$inLibrary = false;

if(isset($inLibrary)){
	$inLibrary = !is_null($inLibrary) && $inLibrary == "true";
}

$q = $this->question_model->getQuestionById($questionId);
$q_data = $q->row();
$questionType = $q_data->qt_name; //select, radio, checkbox or textarea
$link = $this->question_model->getLinkProgramQuestion($programId,$questionId);
$link_data = $link->result();
$link_count = $link->num_rows();

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

//$access = $sysadmin;
echo $q_data->display;

if(!$inUse || $sysadmin)
{?>
<a href="javascript:loadModify('../program_view/editQuestion?program_id=<?php echo $programId;?>&question_id=<?php echo $q_data->id;?>');" >
	<img src="<?php echo base_url()?>img/edit_16.gif" alt="Edit question" title="Edit question"></a>
<?php

	if($inLibrary)
	{
		?>
			<a href="javascript:deleteQuestion(<?php echo $programId;?>,<?php echo $questionId;?>);">
				<img src="<?php echo base_url();?>/img/deletes.gif" style="height:10pt;" alt="Remove question from library" title="Remove question from library">
			</a>
	 
		<?php 
	}
	else
	{
		 ?>
		 <a href="javascript:move(<?php echo $programId;?>,'question',<?php if($link_count > 0){ echo $questionId;} else { echo "-1"; }?>,'','delete');">
			<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove question" title="Remove question"></a>
		<?php }
	 }
else {?>
 		<img src="<?php echo base_url();?>img/deletes.gif" style="opacity:0.4; height:10pt;" alt="Question can't be removed. It has been responded to." title="Question can't be removed. It has been responded to.">
 <?php 
} 

 	if(is_null($q_data->answer_set_id))
	{
		$answerSetId = "-1";	
	}else{
		$answerSetId = $q_data->answer_set_id;
	}
  //= q.getAnswerSet()==null?"-1":""+q->answer_set_id;
	//@SuppressWarnings("unchecked")
	
    $usedAnswerSetIds = $this->session->userdata('usedAnswerSetIds');//(List<String>)session.getAttribute("usedAnswerSetIds");
	
	$inUse = $inUse || isUsedAnsSet($usedAnswerSetIds,$answerSetId); //usedAnswerSetIds.contains(""+answerSetId);
	

 ?><br>
	<div style="padding-left:40px;" id="AnswerSetId_<?php echo $answerSetId;?>">
        <?php 
		;
		$data['answer_set_id'] = $answerSetId;
		$data['question_type'] = $questionType;
		$data['inUse'] = !$editMode;
		$this->load->view('program_view/answerSet',$data);
		?>
	</div>
    
