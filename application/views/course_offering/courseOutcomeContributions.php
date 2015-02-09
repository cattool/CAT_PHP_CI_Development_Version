<?php
$courseOffering = $this->session->userdata("courseOffering");
$programOutcomeId =  intval($program_outcome_id);


//ProgramManager pm = ProgramManager.instance();
//OutcomeManager om = OutcomeManager.instance();

$outcomes = $this->session->userdata("courseOutcomes");

if(empty($outcomes) || !$outcomes->name == "No match to a course outcome")
{
	//$noMatch = "No match to a course outcome";
	//outcomes.add(0, noMatch);
	$bogus['id'] = -1;
	$bogus['name'] = "No match to a course outcome";
}
$links = $this->program_model->getCourseOutcomeLinksForProgramOutcome($courseOffering->id, $programOutcomeId);
$links_data = $links->result();
$noMatchSelected = false;			


foreach($links_data as $linkedOutcome)
{
	if($linkedOutcome->name == "No match to a course outcome")
		$noMatchSelected = true;
	?>
	<tr>
	  <td style="border-bottom:0px; border-top:0px;">
	  <?php 
	  	$bogus = array();
		$outcomesSelect = array();
	  	//.replaceAll("Please select an outcome to add","remove outcome")
		
		$bogus['id'] = "-1";
		$bogus['name'] = "Please select an outcome to add";
		array_push($outcomesSelect,$bogus);
		foreach($outcomes as $tempOutcome){
			
			$bogus['id'] = $tempOutcome->course_outcome_id;
			$bogus['name'] = $tempOutcome->name;
			array_push($outcomesSelect,$bogus);
		}
	  	echo $this->common->createSelect("outcome_selected_" + $linkedOutcome->id,$outcomesSelect,'id','name',$linkedOutcome->course_outcome_id,  "processContributionChange(" . $courseOffering->id . "," . $programOutcomeId  . "," . $linkedOutcome->id . ")",false); ?>
	  </td>  
   </tr>
 <?php 
}

	if(!$noMatchSelected)
	{
	   ?>
		<tr>
		  <td style="border-bottom:0px; border-top:0px;">
			<?php 
				$bogus = array();
				$outcomesSelect = array();
				//.replaceAll("Please select an outcome to add","remove outcome")
				
				$bogus['id'] = "-1";
				$bogus['name'] = "Please select an outcome to add";
				array_push($outcomesSelect,$bogus);
				print_r($outcomes);
				foreach($outcomes as $tempOutcome){
					echo $tempOutcome['course_outcome_id'];
					//$bogus['id'] = $tempOutcome['course_outcome_id'];
					//$bogus['name'] = $tempOutcome->name;
					//array_push($outcomesSelect,$bogus);
				}
				
				//echo $this->common->createSelect("outcome_selected_" + $courseOffering->id ."_".$programOutcomeId,$outcomesSelect,'id','name',-1,  "processContributionChange(" . $courseOffering->id . "," . $programOutcomeId  . ")",true);
			?>
		  </td>
	   </tr>
	<?php 
	} 

?>

