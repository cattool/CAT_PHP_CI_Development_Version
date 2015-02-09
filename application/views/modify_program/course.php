<?php

$courseId = $this->input->get("course_id") ;
$programId = $this->input->get("program_id") ;
$sessionValue = $this->session->userdata("userIsSysadmin");
$sysadmin = !is_null($sessionValue) && $sessionValue;
$editing = false;
//Course o = new Course();
$o_data = array();

if(!is_null($courseId) && strlen(trim($courseId)) > 0)
{
	$o = $this->course_model->getCourseById(intval($courseId));
	$o_data = $o->row();
	$editing = true;
}

?>
<form name="newCourseForm" id="newCourseForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="Course"/>
	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId;?>"/>
	<?php if($o_data->id > 0)
		{
			?><input type="hidden" name="objectId" id="objectId" value="<?php echo $o_data->id?>"/>
			<script type="text/javascript">
				selectedCourseId = <?php echo $o_data->id;?>
			</script>
			<?php
		}
		?>
	<div class="formElement">
		<div class="label">Subject:</div>
		<div class="field"> <input type="text" size="6" name="subject" id="subject" value="<?php echo $editing?$o_data->subject:""?>"  <?php echo $editing?"disabled=\"disabled\"":""?>/></div>
		<div class="error" id="subjectMessage"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<div class="formElement">
		<div class="label">Course Number:</div>
		<div class="field"> <input type="text" size="6" name="courseNumber" id="courseNumber" value="<?php echo $editing?$o_data->course_number:""?>"  <?php echo $editing?"disabled=\"disabled\"":""?>/></div>
		<div class="error" id="titleMessage"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<div class="formElement">
		<div class="label">Title:</div>
		<div class="field"> <input type="text" size="40" name="title" id="title" value="<?php echo $editing?$o_data->title:""?>"/></div>
		<div class="error" id="titleMessage"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<div class="formElement">
		<div class="label">Description:</div>
		<div class="field"> <textarea name="description" id="description" cols="40" rows="6"><?php echo $editing?$o_data->description:""?></textarea></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<?php
	//only show this if the user is a sysadmin, or the home dept is null (new course)
	//List<Organization> homeOrganizations = CourseManager.instance().getOrganizationForCourse(o);

	if($editing && ($sysadmin || is_null($homeOrganizations) || empty($homeOrganizations)) )
	{
		$homeOrganizations = $this->course_model->getOrganizationForCourse($o_data->id);
		$homeOrganizations_data = $homeOrganizations->result();
		$organizationParameter = "";

		$organizationParameter = ",'organization'";
		$this->load->view('courseOrganizations');
		
	/*<div id="courseOrganizationsDiv">
		<jsp:include page="courseOrganizations.jsp"/>
	</div>*/
	} 
	?>
	To assign this course to your department, please contact a system administrator (e.g., gmcte@usask.ca).
	<br/>
	
	<div class="formElement">
		<div class="label"><input type="button" name="saveCourseButton" id="saveCourseButton" value="Save Course" onclick="saveProgram(new Array('subject','courseNumber','title'<?php echo organizationParameter?>),new Array('subject','courseNumber','title','description','organization','program_id'));" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
</form>

		
