<form>
<input type="button" value="Select All Courses" onClick="selectCourses('all');"> &nbsp; <input type="button" value="De-select All Courses" onClick="selectCourses('none');"><br/>

<?php

$organizationId = intval($this->input->get("organization_id"));
$subjectParameter = $this->input->get("subjectParameter") ;
//CourseManager cm = CourseManager.instance();
//Course course = new Course();
//List<String> subjects = cm.getCourseSubjects();
$subjects = $this->course_model->getCourseSubjects();
$subjects_data = $subjects->result();
$subjects_count = $subjects->num_rows();
//out.println(HTMLTools.createSelect("courseSubject",subjects, subjects, subjectParameter, "loadDeptCourseNumbers('courseSubject',"+organizationId+")"));
?>
<select name="courseSubject" id="courseSubject" onchange="loadDeptCourseNumbers('courseSubject',<?php echo $organizationId?>)">
	<?php 
	$subject_list = array();
	$ictr = 0;
	foreach($subjects_data as $rsSubject){
		$subject_list[$ictr] = $rsSubject->subject;	
	?>
    	<option value="<?php echo $rsSubject->subject;?>" <?php if($rsSubject->subject == $subjectParameter){?>selected="selected" <?php }?>> <?php echo $rsSubject->subject?></option>	
        
	<?php 
	$ictr++;	
	}	
		
	?>	
</select>
<?php
//$subjectParameter = $subject_list;

if(strlen($subjectParameter) < 1 && intval($subjects_count) > 0)
{
	//subjectParameter = subjects.get(0);
	$subjectParameter = $subject_list[0];
}
//$courseNumbers_data = array();

$alreadyHasAsHomeorganization = array();

if($subjectParameter != '')
{
	$courseNumbers = $this->course_model->getCourseNumbersForSubject($subjectParameter);
	$courseNumbers_data = $courseNumbers->result();

	//$alreadyHasAsHomeorganization_data = $alreadyHasAsHomeorganization->result_array();
}

?>
<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $organizationId?>" />
<br/>
<?php 
//for(String courseNum : courseNumbers)
foreach($courseNumbers_data as $courseNum)
{
	$selected = "";
	$alreadyHasAsHomeorganization = $this->course_model->getCourseNumbersForSubjectAndOrganization($subjectParameter,$organizationId,$courseNum->course_number);
	$recCount = $alreadyHasAsHomeorganization->num_rows();
	
	if(intval($recCount) > 0){
		//if(alreadyHasAsHomeorganization.contains(courseNum))
		$selected="checked=\"checked\"";
	}
?>
	<input type="checkbox" name="course_number_checkbox_<?php echo $courseNum->course_number;?>"  id="course_number_checkbox_<?php echo $courseNum->course_number;?>" <?php echo $selected;?> value="<?php echo $courseNum->course_number;?>"/><?php echo $courseNum->course_number;?><br/>
<?php
}
?>
<div class="formElement">
		<div class="label">
        	<input type="button" name="saveCoursesButton" id="saveCoursesButton" value="Save Courses for Organization" onclick="saveSystem(new Array('organization_id'),new Array('organization_id','courseSubject'),'OrganizationCourses');" />
        </div>
		<div class="field"><div id="message2Div" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>


</form>


