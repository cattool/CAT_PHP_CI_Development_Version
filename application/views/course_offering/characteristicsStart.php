

<div id="content-and-context" style="overflow:auto;">
			<div class="wrapper" style="overflow:auto;"> 
				<div id="content" style="overflow:auto;"> 
<?php
//CourseManager cm = CourseManager.instance();
$courseOfferingId = $this->input->get("course_offering_id");
$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
$courseOffering_data = $courseOffering->row();
//$pm = ProgramManager.instance();
//OrganizationManager dm = OrganizationManager.instance();
//OutcomeManager om = OutcomeManager.instance();
$programId = $this->session->userdata('programId');

$programIdParameter = intval($this->input->get("program_id"));
if($programIdParameter > 0)
{
	$this->session->set_userdata('programId',$programIdParameter);
	//session.setAttribute("programId",""+programIdParameter);
	$programId = $programIdParameter; 
}
//print_r($courseOffering_data);

if(!$this->common->isValid($programId))
{
	?>
<div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> &gt; 
		<a href="/cat">Curriculum Mapping</a> &gt; <a href="main/myCourses">My Courses</a> &gt; 
</div>  
<?php
}
else
{
	
	
	$program2 = $this->program_model->getProgramById(intval($programId));
	$program2_data = $program2->row();
	$programLink = "";
	$programLink = "<a href=\"/program_view/programWrapper?program_id=".$programId."\">".$program2_data->name."</a> &gt; ";
	$course = $this->course_model->getCourseById($courseOffering_data->course_id);
	$course_data = $course->row();
	$programLink .= "<a href=\"/program_view/courseCharacteristicsWrapper?program_id=".$programId."&course_id=".$course_data->id."\">".$course_data->subject." ".$course_data->course_number."</a> &gt; ";
?>

			
						<div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> &gt; 
							<a href="/cat">Curriculum Alignment Tool</a> &gt; <?php echo $programLink;?> CourseOffering characteristics</p></div>  
						<div id="CourseOfferingCharacteristicsDiv" class="module" style="overflow:auto;">
	<?php
	
}
echo("Currently selected Program :");

$organizations = $this->course_model->getOrganizationForCourseOffering($courseOffering_data->course_id);
$organizations_data = $organizations->result();

$programs = array();
$bogus = array();
$bogus['id'] = -1;
$bogus['name'] = "Please select a Program";
array_push($programs,$bogus);
foreach($organizations_data as $dep)
{
	
	
	$tempProgram = $this->program_model->getProgramByOrgId($dep->org_id);
	$tempProgram_data = $tempProgram->result();
	foreach($tempProgram_data as $tempProgramNew){
			$bogus = array();
			$bogus['id'] = $tempProgramNew->id;
			$bogus['name'] = $tempProgramNew->name;
			array_push($programs,$bogus);
	}
	//array_push($programs,$tempProgram_data);
	//programs.addAll(dm.getProgramOrderedByNameForOrganization(dep));
}

echo($this->common->createSelect("programToSet", $programs, "id", "name", $programId, "setProgramStartId(".$courseOfferingId.")"));

if(!$this->common->isValid($programId))
{
	return;
}

$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();

$featureList = $this->course_model->getFeatures();
$featureList_data = $featureList->result();
$featureList_count = $featureList->num_rows();
$completion = array($featureList_count);
$outcomeList = $this->outcome_model->getOutcomesForCourseOffering($courseOfferingId);
$outcomeList_data = $outcomeList->result();
$outcomeList_count = $outcomeList->num_rows();
$programOutcomeLinklist = $this->program_model->getLinkProgramOutcomeForProgram($programId);
$programOutcomeLinklist_data = $programOutcomeLinklist->result();
$programOutcomeLinklist_count = $programOutcomeLinklist->num_rows();

foreach($featureList_data as $f)
{
	if($f->file_name == "editableTeachingMethods")
	{
		$count = 0;
		$list = $this->course_model->getAllTeachingMethods();
		$list_data = $list->result();
		$list_count = $list->num_rows();
		foreach($list_data as $tm)
		{
			$tempCM = $this->course_model->getLinkTeachingMethodByData($courseOfferingId, $tm->id);
			$tempCM_count = $tempCM->num_rows();
			$tempCM_data = $tempCM->row();
			if ($tempCM_count > 0)
				$count++;
		}
		if($count == 0){
			//completion.add(f.getDisplayIndex()-1,"No data entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = 'No data entered';
			array_push($completion,$bogus);
		}else{
			//completion.add(f.getDisplayIndex()-1, count +" out of " + list.size() + " Instructional Methods have a value entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = $count." out of " . $list_count . " Instructional Methods have a value entered";
			array_push($completion,$bogus);
		}
	}
	else if($f->file_name == "assessmentMethods")
	{
		//NumberFormat formatter = NumberFormat.getInstance();
		//formatter.setMaximumFractionDigits(1);
		$total = 0.0;
		$list = $this->course_model->getAssessmentsForCourseOffering($courseOfferingId);
		$list_data = $list->result();
		$list_count = $list->num_rows();
		foreach($list_data as $l)	
		{
			$total = $total + $l->weight;
		}
		if($list_count == 0){
			//completion.add(f.getDisplayIndex()-1,"No data entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = "No data entered";
			array_push($completion,$bogus);
		}else{
			//completion.add(f.getDisplayIndex()-1, list.size() + " Assessment Methods have been entered, totalling " + formatter.format(total) +" %");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = "Assessment Methods have been entered, totalling " . $total ." %";
			array_push($completion,$bogus);	
		}
			
	}
	else if($f->file_name == "outcomes")
	{
		if($outcomeList_count == 0){
			//completion.add(f.getDisplayIndex()-1,"No data entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = "No data entered";
			array_push($completion,$bogus);
		}else{
	    	//completion.add(f.getDisplayIndex()-1, outcomeList.size() + " Course Learning Outcomes have been added");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = $outcomeList_count . " Course Learning Outcomes have been added";
			array_push($completion,$bogus);	
		}
	}
	else if($f->file_name == "outcomeAssessmentMapping")
	{
		$list = $this->outcome_model->getLinkAssessmentCourseOutcomes(intval($courseOfferingId));
		$list_data = $list->result();
		$list_count = $list->num_rows();
		if($list_count == 0){
			//completion.add(f.getDisplayIndex()-1,"No data entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = "No data entered";
			array_push($completion,$bogus);
		}else{
		   // completion.add(f.getDisplayIndex()-1, list.size() + " links between Course Learning Outcomes and Assessment methods have been added");
		    $tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = $list_count . " links between Course Learning Outcomes and Assessment methods have been added";
			array_push($completion,$bogus);
		}
	}
	else if($f->file_name == "outcomesMapping")
	{
		
		 $count = 0;
		 foreach($programOutcomeLinklist_data as $l)
		 {
			$contributionLink = $this->program_model->getCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $l->program_outcome_id);
			$contributionLink_data = $contributionLink->result();
			$contributionLink_count = $contributionLink->num_rows();
			if($contributionLink_count > 0)
			{
				$count++;
			}
		 }
		 if($count == 0){
			//completion.add(f.getDisplayIndex()-1,"No data entered");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = "No data entered";
			array_push($completion,$bogus);
		 }else{
		    //completion.add(f.getDisplayIndex()-1, count+" out of "+ programOutcomeLinklist.size() + " program outcomes have a contribution assigned");
			$tempIndex = intval($f->display_index) - 1;
			$bogus[$tempIndex] = $count." out of ". $programOutcomeLinklist_count + " program outcomes have a contribution assigned";
			array_push($completion,$bogus);
		 }
	}

	
	else if($f->file_name == "programOutcomeContributions")
	{
		 $count = 0;
		 foreach($programOutcomeLinklist_data as $l)
		 {
			$links = $this->program_model->getCourseOutcomeLinksForProgramOutcome($courseOfferingId, $l->program_outcome_id);
			$links_data = $links->result();
			$links_count = $links->num_rows();
			$count = $count + $links_count;
		 }
		 if($count == 0){
				//completion.add(f.getDisplayIndex()-1,"No data entered");
				$tempIndex = intval($f->display_index) - 1;
				$bogus[$tempIndex] = "No data entered";
				array_push($completion,$bogus);
		 }else{
		    	//completion.add(f.getDisplayIndex()-1, count+" links have been made between Course Learning outcomes and "+ programOutcomeLinklist.size() + " program outcomes");
				$tempIndex = intval($f->display_index) - 1;
				$bogus[$tempIndex] = $count." links have been made between Course Learning outcomes and ". $programOutcomeLinklist_count . " program outcomes";
				array_push($completion,$bogus);
		 }
	}
	else if($f->file_name == "completionTime")
	{
		$questionLinks = $this->question_model->getAllQuestionsForProgram($programId);
		$questionLinks_data = $questionLinks->result();
		$questionLinks_count = $questionLinks->num_rows();
		$responses = $this->question_model->getAllQuestionsWithResponsesForProgramAndOffering($programId,$courseOfferingId);
		$responses_data = $responses->result();
		$responses_count = $responses->num_rows();
		//completion.add(f.getDisplayIndex()-1, responses.size() +" out of "+questionLinks.size() +" questions have been answered");
				$tempIndex = intval($f->display_index) - 1;
				$bogus[$tempIndex] = $responses_count ." out of ".$questionLinks_count ." questions have been answered";
				array_push($completion,$bogus);
	}
	
}
//print_r($courseOffering_data);

?>
					<h2>Characteristics of course offering <?php echo $courseOffering_data->subject;?> 
					<?php echo $courseOffering_data->course_number;?> section 
							<?php echo $courseOffering_data->section_number;?> 
					 (<?php echo $courseOffering_data->term;?>) <?php echo $courseOffering_data->num_students;?> students</h2>
					<table>
					<tr><th>Section</th><th>Data</th></tr>
					<?php 
					$i = 0;
					foreach($featureList_data as $f)
					{
						//Feature f = featureList.get(i);
					?>
					<tr><td><a href="<?php echo site_url();?>/course_offering/characteristicsWizzard?course_offering_id=<?php echo $courseOfferingId?>&feature=<?php echo ($i+1)?>"><?php echo $f->name;?></a></td><td><?php echo $completion[$i+1][$i];?></td></tr>
					<?php 
					$i++;
					} ?>
					
					</table>
					<a href="<?php echo site_url();?>/course_offering/characteristicsWrapper?course_offering_id=<?php echo $courseOfferingId?>">Summary</a>
					</div>
					<div id="modifyDiv" class="fake-input" style="display:none;"></div>
				</div>
			</div>
		</div>
		