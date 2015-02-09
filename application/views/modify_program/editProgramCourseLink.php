<?php
$programId = $this->input->get("program_id") ;

//CourseManager cm = CourseManager.instance();
//LinkCourseProgram o = new LinkCourseProgram();
$courseId = $this->input->get("course_id") ;
//LinkCourseProgram temp = cm.getLinkCourseProgramByCourseAndProgram(Integer.parseInt(programId),Integer.parseInt(courseId));
$temp = $this->course_model->getLinkCourseProgramByCourseAndProgram(intval($programId),intval($courseId));
$temp_data = $temp->row();
$linkExists = false;
if(!is_null($temp))
{
	$linkExists = true;
	$o = $temp_data;
}
?>
<script type="text/javascript">
$(document).ready(function() 
{
	$(".error").hide();
});
</script>
<form name="newObjectForm" id="newObjectForm" method="post" action="" >
	<input type="hidden" name="objectClass" id="objectClass" value="LinkCourseProgram"/>
	<input type="hidden" name="course_id" id="course_id" value="<?php echo $courseId;?>"/>
	<input type="hidden" name="program_id" id="program_id" value="<?php echo $programId;?>"/>
		<?php  
		if($linkExists)
		{
			?><input type="hidden" name="objectId" id="objectId" value="<?php echo $o->id;?>"/>
			<?php 
		}

		//CourseClassification classification = linkExists ? o.getCourseClassification() : new CourseClassification();
		
		//List<CourseClassification> classifications = cm.getCourseClassifications();
		$classifications = $this->course_model->getCourseClassifications();
		$classifications_data = $classifications->result();
		//List<String> classifcationIds = new ArrayList<String>();
		//List<String> classifcationNames = new ArrayList<String>();
		
		/*
		for(CourseClassification classif : classifications)
		{
			classifcationIds.add(""+classif.getId());
			classifcationNames.add(classif.getName());
		}*/
		?>
		<div class="formElement">
			<div class="label">This class is :</div>
			<div class="field">
			<?php 
			$classificationTemp = array();
		foreach($classifications_data as $tempClassification){
			$bogus = array();
			$bogus['id'] = $tempClassification->id;
			$bogus['name'] = $tempClassification->name;
			array_push($classificationTemp,$bogus);
		}	
			
		echo($this->common->createSelect("courseClassifcation",$classificationTemp, 'id', $linkExists ? 'name' : '', '',null));
			?>
			</div>
		</div>
		<hr/>
		<?php 
		//Time time = o.getTime();
		//List<Time> times = cm.getCourseTimes();
		$times = $this->course_model->getCourseTimes();
		$times_data = $times->result();
		?>
		<div class="formElement">
			<div class="label">This class is typically taken :</div>
			<div class="field">
			<?php 
		$timesTemp = array();
		foreach($times_data as $tempTime){
			$bogus = array();
			$bogus['id'] = $tempTime->id;
			$bogus['name'] = $tempTime->name;
			array_push($timesTemp,$bogus);
		}	
			
		echo($this->common->createSelect("time",$timesTemp, "id","name", $linkExists ? "" + $times_data[0]->id: null, null));
			?>
			</div>
		</div>
		<hr/>
		<br/>

		<div class="formElement">
			<div class="label"><input type="button" name="saveButton" id="saveButton" value="Save" onclick="saveProgram(new Array('courseClassifcation','time'),new Array('courseClassifcation','time','course_id','program_id'),'LinkCourseProgram');" /></div>
			<div class="field"><div id="messageDiv" class="error" style="display:none;"></div></div>
			<div class="spacer"> </div>
		</div>
</form>
