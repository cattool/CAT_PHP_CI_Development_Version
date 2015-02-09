<?php

$programId = $this->input->get("program_id") ;
$linkId = $this->input->get("link_id") ;

//CourseManager cm = CourseManager.instance();
//LinkCourseProgram o = new LinkCourseProgram();
//Course course = new Course();
$subject = null;
$courseNumber = null;
$courseTitle = null;
$courseLoaded = false;

if(!is_null($linkId) && strlen(trim($linkId)) > 0)
{
	$o_rs = $this->course_model->getCourseForLinkProgram(intval($linkId));
	$o = $o_rs->row();
	$course = $o->course;
	$subject = $o->c_subject;
	$courseTitle = $o->c_title;
	$courseNumber = $o->c_course_number;
	$courseLoaded = true;
}

$courseId = $courseLoaded ? $o->c_id : $this->input->get("course_id");


if(!$courseLoaded)
{
	if(!is_null($courseId)  && strlen(trim($courseId)) > 0)
	{
		$course_rs = $this->course_model->getCourseById(intval($courseId));
		$course = $course_rs->row();
		$subject = $course->subject;
		$courseNumber = $course->course_number;
	}
}

?>
<script type="text/javascript">
$(document).ready(function() 
{
	$(".error").hide();
});
</script>
<form name="newObjectForm" id="newObjectForm" method="post" action="" >
	
    <!--<jsp:include page="/auth/modifyProgram/chooseCourse.jsp" />-->
    <div id="courseInfoDiv">
    <?php
	
  		$this->load->view('modify_program/chooseCourse');
	
	?>
    </div>
	<div id="addCourseLinkDiv">
	<?php 
	if($o->id > 0)
	{//Course is selected, show classification, start and end
		//CourseClassification classification = o.getCourseClassification();
		$classification = $o->course_classification_id;
		$classifications_rs = $this->course_model->getCourseClassifications();
		$classifications = $classifications_rs->result();
		
		/*
		List<String> classifcationIds = new ArrayList<String>();
		List<String> classifcationNames = new ArrayList<String>();
		*/
		$classifcationIds = array();
		$classifcationNames = array();
		
		foreach($classifications as $classif)
		{
			array_push($classifcationIds,$classif->id);
			array_push($classifcationNames,$classif->name);
			//classifcationIds.add(""+classif.getId());
			//classifcationNames.add(classif.getName());
		}
		//echo($this->common->createSelect("courseClassifcation",$classifcationIds,$classifcationNames, $classification->id, null));
		$time = $o->time_id;
		
		$times_rs = $this->course_model->getCourseTimes();
		$times = $times_rs->result();
		$bogus = array();
		$dataTimes = array();
		foreach($times as $temptimes){
				
				$bogus['id'] = $times->id;
				$bogus['name'] = $times->name;
				array_push($dataTimes,$bogus);
		}

		//echo($this->common->createSelect("time",$dataTimes,"id","name", $time.getId(), null));
	}
	?>	<br/>
	</div>
</form>

