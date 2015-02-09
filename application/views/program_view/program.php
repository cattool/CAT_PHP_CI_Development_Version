<?php
$programId = $this->input->get("program_id");
$this->session->set_userdata('programId',$programId);

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

$access = $sysadmin;

/*
if(!is_null($programId) && strlen($programId) > 0)
{
	$organization = $this->program_model->getOrganizationByProgramId($programId);	
	$organization_data = $organization->row();
}
*/

//ProgramManager pm = ProgramManager.instance();

$o = $this->program_model->getProgramById(intval($programId));
$o_data = $o->row();
$organization = $this->program_model->getOrganizationByProgramId($o_data->id);
$organization_data = $organization->row();
$uagent = $_SERVER['HTTP_USER_AGENT'];
$clientBrowser = $this->common->os_info($uagent);

?>
<h2><?php  echo $o_data->name;?>
	<?php if($sysadmin){?> &nbsp; 
    	<a href="javascript:loadModify('../modify_program/program?organization_id=<?php echo $organization_data->organization_id;?>&program_id=<?php echo $o_data->id;?>','characteristicsModifyDiv');" class="smaller">
        	<img src="<?php echo base_url()?>img/edit_16.gif" alt="Edit program details" title="Edit program details">
        </a>
	<?php } ?>
</h2>
		<a href="javascript:toggleDisplay('programQuestionEditSection','<?php echo $clientBrowser;?>','<?php echo base_url()?>');">
        	<img src="<?php echo base_url()?>img/closed_folder_<?php echo $clientBrowser;?>.gif" id="programQuestionEditSection_img">Manage Final Questions</a>
<div id="programQuestionEditSection_div" style="display:none;">
					
	<div id="programQuestionsDiv">
		<!--<jsp:include page="programQuestions.jsp"/>-->
        <?php $this->load->view('program_view/programQuestions');?>
	</div>
</div>
<h3>Courses</h3>

<div id="programCoursesDiv">
	<!---<jsp:include page="programCourses.jsp"/>--->
    <?php $this->load->view('program_view/programCourses');?>
</div>
<div id="addCourseToProgram" class="fake-input" style="display:none;"></div>

<?php
if($access)
{?>
<h3>Program Outcomes</h3>
<br><br>
	<a href="javascript:toggleDisplay('manageProgramOutcomes','<?php echo $clientBrowser;?>','<?php echo base_url()?>');">
    	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser;?>.gif" id="manageProgramOutcomes_img">Manage Program Outcomes</a>
<div id="manageProgramOutcomes_div" style="display:none;">
	
	
	<div id="programOutcomesDiv">
		<!--<jsp:include page="programOutcomes.jsp"/>-->
        <?php $this->load->view('program_view/programOutcomes');?>
	</div>
	<div id="addOutcomeToProgram" class="fake-input" style="display:none;"></div>
</div>
<div>



<?php }
?>
<div id="outcomesMappingDiv">
	<!--
	<jsp:include page="outcomesMapping.jsp">
		<jsp:param value="<%=programId%>" name="program_id"/>	
	</jsp:include>
    -->
    
    <?php 
		$data['program_id'] = $programId;
		$this->load->view('program_view/outcomesMapping',$data);
	?>
</div>
<h3>Summary of Course Data</h3>
<p>
Summaries are presented for specific terms. Select the terms you would like to review (e.g., 201201 refers to Term 2 starting January 2012).
</p>
<form>
<input type="button" value="Select All Terms" onClick="selectTerms('all',<?php echo $programId;?>);"> &nbsp; 
<input type="button" value="De-select All Terms" onClick="selectTerms('none',<?php echo $programId;?>);">
<br/>
<?php
$availableTerms = $this->program_model->getAllAvailableTerms($o_data->id);
$availableTerms_data = $availableTerms->result();
foreach($availableTerms_data as $term)
{
	?>
	<input class="termCheckbox" type="checkbox" id="termCB_<?php echo $term->term;?>" name="termCB_<?php echo $term->term;?>" value="<?php echo $term->term?>" onClick="loadOutcomeMappings(<?php echo $programId;?>);">
    <?php echo $term->term;?> &nbsp; 
	<?php
}
?>
</form>
</div>


<h3>Courses' Contribution to Program Outcomes</h3>
<div id="summaryProgramOutcomesDiv">
	<!--<jsp:include page="summaryProgramOutcomes.jsp"/>-->
    <?php $this->load->view('program_view/summaryProgramOutcomes');?>
</div>

<div id="outcomes"></div>
<hr/>

<h3>Assessment Distribution and Instructional Strategies</h3>
<br>
Select the courses you would like view in the charts below.
<div id="programCourseAssessmentsDiv">
	<!--<jsp:include page="/auth/programView/programCourseAssessments.jsp">
		<jsp:param value="<%=programId%>" name="program_id"/>	
	</jsp:include>-->
    <?php 
		$data['program_id'] = $programId;
		$this->load->view('program_view/programCourseAssessments',$data);
	?>

</div>

<?php 
if(false && $access)
{?>
<a href="modify_Program/programExportprogram_id=<?php echo $programId;?>" class="smaller">Export to Excel (under construction)</a>
<?php } ?>
	
