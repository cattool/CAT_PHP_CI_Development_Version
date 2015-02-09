<?php
$programId = $this->input->get("program_id") ;
?>
	<div id="existingCourseSelector">
		<!---<jsp:include page="existingCourseSelector.jsp"/>--->
        <?php $this->load->view('modify_program/existingCourseSelector');?>
	</div>
<br>
	<a href="javascript:openDiv('addCourseDiv');" class="smaller"><img src="<?php echo base_url();?>img/add_24.gif" style="height:14pt;" alt="Add" >Add a course (the one I am looking for isn't in the system yet)</a>
<br>

<div id="addCourseDiv" style="display:none;">
	
	<!--<jsp:include page="/auth/modifyProgram/course.jsp"/>-->
    <?php 
	$this->load->view('modify_program/course');
	?>
</div>

		
