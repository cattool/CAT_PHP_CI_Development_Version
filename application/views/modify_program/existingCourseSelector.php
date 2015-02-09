<?php
$programId = $this->input->get("program_id");
$subjectParameter = $this->input->get("subjectParameter") ;
$courseNumberParameter = $this->input->get("courseNumberParameter") ;
$courseId = $this->input->get("courseId");
$courseLoaded = false;
//CourseManager cm = CourseManager.instance();
//Course course = new Course();


if(!is_null($courseId)  && strlen(trim($courseId)) > 0)
{
	$course = $this->course_model->getCourseById(intval($courseId));
	$course_data = $course->row();
	$subjectParameter = $course_data->subject;
	$courseNumberParameter = $course_data->course_number;
	$courseLoaded = true; 
}
else if(!is_null($courseNumberParameter) && strlen($courseNumberParameter)>0 && !is_null($subjectParameter) && strlen($subjectParameter)>0)
{
	$course = $this->course_model->getCourseBySubjectAndNumber($subjectParameter,$courseNumberParameter);
	$course_data = $course->row();
	$courseLoaded = true;
}
if($courseLoaded)
{
	
	?><input type="hidden" name="courseId" id="courseId" value="<?php echo $course_data-id;?>"/>
	<?php
}
$subjects = $this->course_model->getCourseSubjects();
$subjects_data = $subjects->result();
$subjects_count = $subjects->num_rows();
$subjectSelect = array();

foreach($subjects_data as $tempSubjectNew){
			$bogus = array();
			$bogus['subject'] = $tempSubjectNew->subject;
			array_push($subjectSelect,$bogus);
	}


echo($this->common->createSelect("courseSubject",$subjectSelect, 'subject', 'subject',$subjectParameter, "loadCourseNumbers('courseSubject',".$programId.")")).'&nbsp';
if(!$courseLoaded &&  (is_null($subjectParameter) || strlen($subjectParameter)<1) && $subjects_count>0)
{
	$subjectParameter = $subjectSelect[0]['subject'];//$subjects_data->subject;
}

//List<String> courseNumbers = new ArrayList<String>();
$courseNumbersRec = array();

if(!is_null($subjectParameter))
{
	
	$courseNumbers = $this->course_model->getCourseNumbersForSubject($subjectParameter);
	$courseNumbers_data = $courseNumbers->result();
	$courseNumbers_count = $courseNumbers->num_rows();
	if((is_null($courseNumberParameter) || strlen($courseNumberParameter)<1) &&  $courseNumbers_count>0)
	{
		$courseNumberParameter = $courseNumbers_data[0]->course_number;
		$course = $this->course_model->getCourseBySubjectAndNumber($subjectParameter,$courseNumberParameter);
		$course_data = $course->row();
		$courseLoaded = true;
	}
	
}


foreach($courseNumbers_data as $tempCourseSubject){
			$bogus = array();
			$bogus['course_number'] = $tempCourseSubject->course_number;
			array_push($courseNumbersRec,$bogus);
	}

echo($this->common->createSelect("courseNumberParameter",$courseNumbersRec, 'course_number', 'course_number',$courseNumberParameter, "loadCourseFromSubjectAndNumber('".$subjectParameter."','courseNumberParameter',".$programId.")")).'&nbsp;';
if($courseLoaded)
{
	echo($course_data->title);
	{
		?>
		<script type="text/javascript">
			selectedCourseId = <?php echo $course_data->id?>;
		</script>
		<?php 
	}
	$tempTest = $this->course_model->isAlreadyPartOfProgram(intval($programId),$course_data->id);
	if($tempTest)
	{
		echo("<span style='font-weight:boild;color:red;'> Already part of this program</span>");	
	}
	else
	{
		?>
		<a href="<?php echo site_url();?>/program_view/courseCharacteristicsWrapper?program_id=<?php echo $programId?>&course_id=<?php echo $course_data->id;?>">Add this course</a>
		<?php 
	}
}
?>

