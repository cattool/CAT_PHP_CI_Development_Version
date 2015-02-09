<?php

$answerSetId = intval($answer_set_id);
$questionType = $question_type;
$inUseString = $inUse;
$programId = $this->input->get("program_id");
$editable = is_null($inUseString) || $inUseString == "false";
$editModeString = false;

if(isset($editMode)){
	$editModeString = $editMode;	
}

//$editMode = is_null($editModeString) && $editModeString == 1;
$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
//QuestionManager qm = QuestionManager.instance();

//@SuppressWarnings("unchecked")
$usedAnswerSetIds = $this->session->userdata("usedAnswerSetIds");

//$inUse = usedAnswerSetIds.contains(""+answerSetId);

$inUse = false;


foreach($usedAnswerSetIds as $usedAnswer){
	if($usedAnswer->answer_set_id == $answerSetId){
		$inUse = true;	
	}	
}

$editable = (!$inUse && $editable && $editMode) || ($sysadmin && $editMode);
if($questionType == "textarea")
{
	?>
	Open answer
	<?php
}


else
{

	$set = null;
	if ($answerSetId < 0)
	{
		 $set = $this->question_model->getAnswerSetById($this->input->get("answer_set_id"));
		 $set_data = $set->result();
		 $set_count = $set->num_rows();
		 $answerSetId = $set_data->id;
	}
    else
	{
	  	 $set = $this->question_model->getAnswerSetById($answerSetId);
		 $set_data = $set->result();
		 $set_count = $set->num_rows();
	}
	
	
	if($questionType == "select")
	{ ?>
		<div id="Question<?php echo $answerSetId;?>" style="border:1px solid grey; width:200px;">
	<?php }	
	$count = 1;
	
	
	//Set<AnswerOption> list = set.getAnswerOptions();
	$lastOne = $set_count-1;// list.size()-1;
	foreach($set_data as $option)
	{
			
		if($editable)
		{
			echo 'true';
			if($count>1)
			{?>
			<a href="javascript:move(<?php echo $programId;?>,'answerOption',<?php echo $option->ansOpt_id;?>,'<?php echo $questionType;?>','up',<?php echo $answerSetId;?>);">
            	<img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/></a>
			<?php }
			else
			{
				?>
				<img src="<?php echo base_url();?>img/blankbox.gif"  style="width:10px; height:15px;" alt=" "/>
				<?php 
			}
			if($count <= $lastOne)
			{?>
			<a href="javascript:move(<?php echo $programId;?>,'answerOption',<?php echo $option->ansOpt_id;?>,'<?php echo $questionType;?>','down',<?php echo $answerSetId;?>);">
            	<img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/></a>
			<?php }
			else
			{
				?>
				<img src="<?php echo base_url()?>img/blankbox.gif"  style="width:10px; height:15px;" alt=" "/>
				<?php 
			}
		}
	
		if($questionType == "radio")
		{
			?>
			<input type="radio" name="Question_<?php echo $answerSetId;?>" disabled="disabled" value="<?php echo $option->ansOpt_value;?>">
            	<?php echo $option->ansOpt_display;?> <span style="opacity:0.4;">(<?php echo $option->ansOpt_value;?>)</span></input>
			<?php
		}
		else if($questionType == "checkbox")
		{
			?>
			<input type="checkbox" name="Question_<?php echo $answerSetId ."_".$option->id;?>" disabled="disabled" value="<?php echo $option->ansOpt_value;?>">
            	<?php echo $option->ansOpt_display;?> <span style="opacity:0.4;">(<?php echo $option->ansOpt_value;?>)</span></input>
			<?php
		}
		else if($questionType == "select")
		{
			?>
			<?php echo $option->ansOpt_display;?> <span style="opacity:0.4;">(<?php echo $option->ansOpt_value;?>)</span>
			<?php
		} 
		if($editable)
		{
			?>
			<a href="javascript:editAnswerOption(<?php echo $programId;?>,<?php echo $answerSetId;?>,<?php echo $option->ansOpt_id; ?>,'edit','<?php echo $questionType;?>');"><img src="<?php echo base_url();?>/img/edit_16.gif" alt="Edit answer option" title="Edit answer option"></a>
			<a href="javascript:editAnswerOption(<?php echo $programId;?>,<?php echo $answerSetId;?>,<?php echo $option->ansOpt_id; ?>,'delete','<?php echo $questionType;?>');"><img src="<?php echo base_url();?>/img/deletes.gif" style="height:10pt;" alt="Remove answer option" title="Remove answer option"></a>
			<?php 
		}
		echo "<br/>";
		
		
		$count++;
	}
	
	if($questionType == "select")
	{ ?>
		</div>
	<?php }
	if($editable)
	{
	?>
	<a href="javascript:editAnswerOption(<?php echo $programId;?>,<?php echo $answerSetId;?>,-1,'edit','<?php echo $questionType;?>');">
    	<img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add answer option" title="Add answer option"> Add answer option</a>

	<?php }
	
}


?>
