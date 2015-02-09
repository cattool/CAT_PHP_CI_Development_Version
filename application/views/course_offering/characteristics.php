
<script src="<?php echo base_url();?>js/bluff/js-class.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/bluff/bluff-min.js" type="text/javascript"></script>
<!--[if IE]>	<script src="/cat/js/bluff/excanvas.js" type="text/javascript"></script><![endif]-->

<?php

$courseOfferingId = $this->input->get("course_offering_id");
//CourseManager cm = CourseManager.instance();


$offering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));

$offering_data = $offering->row();
?>
<a href="<?php echo site_url();?>/course_offering/characteristicsStart?course_offering_id=<?php echo $courseOfferingId?>">Start page</a>
<h2>Summary of course offering <?php echo $offering_data->subject;?> 
<?php echo $offering_data->course_number;?> section 
<?php echo $offering_data->section_number;?> 
 (<?php echo $offering_data->term;?>) <?php echo $offering_data->num_students;?> students</h2>
<div id="exportDataDiv">
	<!--
	<jsp:include page="exportOfferingData.jsp">
		<jsp:param value="<%=offering.getId()%>" name="course_offering_id"/>	
	</jsp:include>
    -->
    <?php 
		$data['course_offering_id'] = $offering_data->id;
		$this->load->view('course_offering/exportOfferingData',$data);
	?>
</div>
 
 <?php
$featureList = $this->course_model->getFeatures();
$featureList_data = $featureList->result();
foreach($featureList_data as $f){
?> 
 <div id="<?php echo $f->file_name;?>Div">
 	<!--
	<jsp:include page='<%=f.getFileName()+".jsp"%>'>
		<jsp:param value="<%=offering.getId()%>" name="course_offering_id"/>	
	</jsp:include>
    -->
    <?php 
		echo $f->file_name;
		$data['course_offering_id'] = $offering_data->id;
		$this->load->view('course_offering/'.$f->file_name,$data);
	?>
</div>
<hr/>
<?php
}
?>
<div id="courseOfferingCommentsDiv">
	<!--
	<jsp:include page="comments.jsp">
		<jsp:param value="<%=offering.getId()%>" name="course_offering_id"/>	
	</jsp:include>
    -->
    <?php $this->load->view('course_offering/comments');?>
</div>




