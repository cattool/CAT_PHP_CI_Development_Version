
<?php
$programId = intval($this->session->userdata("programId"));

$programLink = "";
if($programId >= 0 )
{
	$program = $this->program_model->getProgramById($programId);
	$program_data = $program->row();
	$programLink = "<a href=\"/program_view/programWrapper?program_id=".$programId."\">".$program_data->name."</a> &gt; ";
	$courseOfferingId = $this->input->get("course_offering_id");
	//CourseManager cm = CourseManager.instance();
	$offering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
	$offering_data = $offering->row();
	//Course course = offering.getCourse();
	$programLink .= "<a href=\"/program_view/courseCharacteristicsWrapper?program_id=".$programId."&course_id=".$offering_data->course_id . "\">" . $offering_data->subject ." ". $offering_data->course_number."</a> &gt; ";
}
else
{
	$programLink = "<a href=\"myCourses\">My Courses</a> &gt; ";
}


?>

<script type="text/javascript">
var graphsToDraw = new Array();
$("document").ready(function() {
	drawGraphs();
});
function drawGraphs()
{
	for(var i=0; i< graphsToDraw.length ; i++) 
	{
		eval(graphsToDraw[i]);
	}
}

</script>
		<div id="content-and-context" style="overflow:auto;">
			<div class="wrapper" style="overflow:auto;"> 
				<div id="content" style="overflow:auto;"> 
					<div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> &gt; 
						<a href="/cat">Curriculum Alignment Tool</a> &gt; <?php echo $programLink;?> CourseOffering characteristics</p></div>  
					<div id="CourseOfferingCharacteristicsDiv" class="module" style="overflow:auto;">
						<!--<jsp:include page="characteristics.jsp"/>-->
                        <?php $this->load->view('course_offering/characteristics');?>
					</div>
					<div id="modifyDiv" class="fake-input" style="display:none;"></div>
				</div>
			</div>
		</div>

