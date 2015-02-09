<?php

//CourseManager cm = CourseManager.instance();
$featureList = $this->course_model->getFeatures();
$featureList_data = $featureList->result();
$featureList_count = $featureList->num_rows();
$featureId = intval($this->input->get("feature"));


$nextFeature = 0;
$prevFeature = 0;
if($featureId <= 1)
{
	$featureId = 1;
	$prevFeature = -1;
	$nextFeature = 2;
}
else if($featureId == $featureList_count)
{
	$prevFeature  = $featureId - 1;
	$nextFeature = -1;
}
else
{
	$prevFeature = $featureId - 1;
	$nextFeature = $featureId + 1;
}

//Feature feature = featureList.get(featureId-1);
$programId = intval($this->session->userdata('programId'));

$programLink = "";
$courseOfferingId = intval($this->input->get("course_offering_id"));

if ($courseOfferingId <= 0)
{
	?><h1>NO COURSE OFFERING ID FOUND!!!</h1>
	<?php
	return;
}
$courseOffering = $this->course_model->getCourseOfferingById($courseOfferingId);
$courseOffering_data = $courseOffering->row();
if($programId > 0 )
{
	$program = $this->program_model->getProgramById($programId);
	$program_data = $program->row();
	$programLink = "<a href=\"program_view/programWrapper?program_id=".$programId."\">".$program_data->name."</a> &gt; ";	
	//$course = courseOffering.getCourse();
	$programLink += "<a href=\"program_view/courseCharacteristicsWrapper?program_id=".$programId."&course_id=".$courseOffering_data->course_id."\">".$courseOffering_data->subject." ". $courseOffering_data->course_number."</a> &gt; ";
}
else
{
	$programLink = "<a href=\"myCourses\">My Courses</a> &gt; ";
}


?>


		<div id="content-and-context" style="overflow:auto;">
			<div class="wrapper" style="overflow:auto;"> 
				<div id="content" style="overflow:auto;"> 
					<div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> &gt; 
						<a href="/cat">Curriculum Alignment Tool</a> &gt; <?php echo $programLink;?> CourseOffering characteristics</p></div>  
					<div id="characteristicsWizzardDiv" class="module" style="overflow:auto;">
					<form>
					<?php if($prevFeature < 0){ ?>
						<input type="button" onclick="document.location='characteristicsStart?course_offering_id=<?php echo $courseOfferingId;?>';" value="Start page">
					<?php }
					else
					{?>	
					   <input type="button" onclick="document.location='characteristicsStart?course_offering_id=<?php echo $courseOfferingId;?>';" value="Start page">
					   <input type="button" onclick="document.location='characteristicsWizzard?feature=<?php echo $prevFeature;?>&course_offering_id=<?php echo $courseOfferingId;?>';" value="Previous">
					<?php }
					
					?><img src="<?php echo base_url()?>img/blankbox.gif" style="width:500px;height:10px;"/>
					<?php
					if($nextFeature < 0){
					?>
						<input type="button" onclick="document.location='characteristicsWrapper?course_offering_id=<?php echo $courseOfferingId;?>';" value="Summary" style="float:right;margin-right:10px" /> 
					<?php }
					else
					{?>
					<input type="button" onclick="document.location='characteristicsWrapper?course_offering_id=<?php echo $courseOfferingId;?>';" value="Summary"  style="margin:auto" />
                    <input type="button" onclick="document.location='characteristicsWizzard?feature=<?php echo $nextFeature;?>&course_offering_id=<?php echo $courseOfferingId;?>';" value="Next"  style="float:right;margin-right:10px" /> 
					 
				
					<?php } ?>
					</form>
					<h2>Characteristics of course offering <?php echo $courseOffering_data->subject;?> <?php echo $courseOffering_data->course_number;?> section 
							<?php echo $courseOffering_data->section_number;?> 
					 (<?php echo $courseOffering_data->term;?>) <?php echo $courseOffering_data->num_students;?> students</h2>
						<?php $featureTempId = $featureId - 1;?>
						<div id="<?php echo $featureList_data[$featureTempId]->file_name;?>Div" class="module" style="overflow:auto;">
					       <?php
						   echo $featureList_data[$featureTempId]->file_name;
						   $data['course_offering_id'] = $courseOfferingId;
						   $this->load->view('course_offering/'.$featureList_data[$featureTempId]->file_name);
						  
						   ?>
                           <!--
                           <jsp:include page='<?php //echo feature.getFileName()+".jsp"?>' >
					       		<jsp:param name="course_offering_id" value='<?php //echo courseOfferingId?>'/>
					       </jsp:include>
                           -->
					    </div>
					  <form>
					<?php if($prevFeature < 0){ ?>
						<input type="button" onclick="document.location='characteristicsStart?course_offering_id=<?php echo $courseOfferingId;?>';" value="Start page">
					<?php  }
					else
					{?> 
					   <input type="button" onclick="document.location='characteristicsWizzard?feature=<?php echo $prevFeature;?>&course_offering_id=<?php echo $courseOfferingId;?>';" value="Previous">
					<?php }
					
					?><img src="<?php echo base_url();?>img/blankbox.gif" style="width:500px;height:10px;"/>
					<?php 
					if($nextFeature < 0){
					?>
						<input type="button" onclick="document.location='characteristicsWrapper?course_offering_id=<?php echo $courseOfferingId?>';" value="Summary"/> 
					<?php }
					else
					{?>
					<input type="button" onclick="document.location='characteristicsWizzard?feature=<?php echo $nextFeature;?>&course_offering_id=<?php echo $courseOfferingId;?>';" value="Next" style="float:right;margin-right:10px"/> 
					<?php } ?>
					</form>
				     
					</div>
					<div id="modifyDiv" class="fake-input" style="display:none;"></div>
				</div>
			</div>
		</div>
	
