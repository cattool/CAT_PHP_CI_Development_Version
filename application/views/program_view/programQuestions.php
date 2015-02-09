<?php

if(!isset($program_id)){
	$programId = $this->input->get("program_id");
}else{
	$programId = $program_id;
}

$this->session->set_userdata('programId',$programId);

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

$access = $sysadmin;

//int programId = HTMLTools.getInt(request.getParameter("program_id"));
//Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
//boolean sysadmin = sessionValue != null && sessionValue;
//boolean access = sysadmin;
if($programId > -1)
{
	//Organization organization = OrganizationManager.instance().getOrganizationByProgramId(""+programId);	
	//@SuppressWarnings("unchecked")
	//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
	
	$program =  $this->program_model->getProgramById(intval($programId));
	$program_data = $program->row();
	$orgId = $program_data->organization_id;
	
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($orgId,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	
	//access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+organization.getId());
	$access = $sysadmin || ($userHasAccessToOrganizations < 0);
}
if(!$access)
{
	echo "You don't appear to have the proper access to manage questions for this program.";
	return;
}
//QuestionManager qm = QuestionManager.instance();


$usedAnswerSetIds = $this->question_model->getAllAnswerSetIdsWithResponses();
$usedAnswerSetIds_data = $usedAnswerSetIds->result();

$this->session->set_userdata("usedAnswerSetIds",$usedAnswerSetIds_data);


$o = $this->program_model->getProgramById($programId);
$o_data = $o->row();
$questionLinks = $this->question_model->getAllQuestionsForProgram($programId);
$questionLinks_data = $questionLinks->result();
$questionLinks_count = $questionLinks->num_rows();

?>
<ul>
	<li>	<a href="javascript:loadModify('../program_view/editQuestion?program_id=<?php echo $programId;?>&question_id=-1');" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add/create/edit a question" title="Add/create/edit a question"/>
				Add/create/edit a question
			</a>
	</li>
<?php 

$questionCount=1;
$withAnswers = $this->question_model->getAllQuestionsWithResponsesForProgram($programId);
$withAnswers_data = $withAnswers->result();
$lastQuestion = $questionLinks_count - 1;
foreach($questionLinks_data as $q)
{
	
	?><li><?php
	$questionType = $q->qt_name; //select, radio, checkbox or textarea
	
	if($questionCount>1)
	{?>
	<a href="javascript:move(<?php echo $programId?>,'question',<?php echo $q->question_id;?>,<?php echo $o_data->id;?>,'up');">
    	<img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/></a>
	<?php }
	else
	{
		?>
		<img src="<?php echo base_url()?>img/blankbox.gif"  style="width:10px; height:15px;" alt=" "/>
		<?php
	}
	
	if($questionCount <= $lastQuestion)
	{?>
	<a href="javascript:move(<?php echo $programId;?>,'question',<?php echo $q->question_id;?>,<?php echo $o_data->id;?>,'down');">
    	<img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/></a>
	<?php }
	else
	{
		?>
		<img src="/cat/images/blankbox.gif"  style="width:10px; height:15px;" alt=" "/>
		<?php
	}
	
		$data['question_id'] = $q->question_id;
		$data['questionInUse'] = isUsed($withAnswers_data, $q->question_id);
		$data['editMode'] = false;
		$data['program_id'] = $programId;
		
		$this->load->view('program_view/question',$data);
		
	?>
	    
	</li>
	<?php 
	$questionCount++;
}
if($questionLinks_count < 1)
{
	echo "No questions added (yet).";
}

?>
</ul>

<?php 
function isUsed($list, $qId)
{
	
	foreach($list as $inList)
	{
		if($inList->question_id == $qId)
			return true;
	}
	
	return false;
	
}

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
