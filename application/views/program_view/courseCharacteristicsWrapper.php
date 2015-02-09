<?php
$programId = $this->input->get("program_id");
$p = $this->program_model->getProgramById(intval($programId));
$p_data = $p->row();
?>

<div id="content-and-context" style="overflow:auto;">
    <div class="wrapper" style="overflow:auto;"> 
        <div id="content" style="overflow:auto;"> 
            <div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> &gt; <a href="/cat">Curriculum Alignment Tool</a> &gt; 
            <a href="program_view/programWrapper?program_id=<?php echo $p_data->id;?>"><?php echo $p_data->name;?></a> 
            &gt; CourseOffering characteristics</p></div>  
            <div id="CourseCharacteristicsDiv" class="module" style="overflow:auto;">
               <!--- <jsp:include page="courseCharacteristics.jsp"/>--->
               <?php 
			   		$this->load->view('program_view/courseCharacteristics');
			   			
			   ?>
            </div>
            <div id="modifyDiv" class="fake-input" style="display:none;"></div>
        </div>
    </div>
</div>
