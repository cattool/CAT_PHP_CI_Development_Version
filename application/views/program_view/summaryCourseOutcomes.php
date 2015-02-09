<?php
$courseId = $this->input->get("course_id");
$programId = $this->input->get("program_id");
//CourseManager cm = CourseManager.instance();
$course = $this->course_model->getCourseById(intval($courseId));
$offerings = $this->course_model->getCourseOfferingsForCourse($courseId);
$offerings_data = $offerings->result();
$offerings_count = $offerings->num_rows();
$offeringsWithData = $this->course_model->getCourseOfferingsForCourseWithProgramOutcomeData($courseId);
$offeringsWithData_data = $offeringsWithData->result();
$offeringsWithData_count = $offeringsWithData->num_rows();
$contributionData = $this->course_model->getCourseOfferingsContributionsForCourse($courseId);
$contributionData_data = $contributionData->result();
$terms = $this->course_model->getAvailableTermsForCourse($courseId);
$terms_data = $terms->result();


$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;

//OutcomeManager om = OutcomeManager.instance();
//ProgramManager pm = ProgramManager.instance();

$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();
$groups = $this->program_model->getProgramOutcomeGroupsProgram($programId);
$groups_data = $groups->result();
$groups_count = $groups->num_rows();
$optionValues = $this->program_model->getContributionOptions();
$optionValues_data = $optionValues->result();

$masteryValues = $this->program_model->getMasteryOptions();
$masteryValues_data = $masteryValues->result();
if($groups_count < 1)
{
	echo("No Program Outcomes found");
	return;
}
if($offerings_count < 1)
{
	echo("No Course Offerings found");
	return;
}
if($offeringsWithData_count < 1)
{
	echo("No contribution data entered");
	return;
}

?>
<hr/>
<strong>The Emphasis and Depth value represent the data entered in the Course Offerings. (<?php echo $offeringsWithData_count;?> out of <?php echo $offerings_count;?> sections have mapping data entered)</strong>
<br/>Emphasis: 
<?php 
$firstOption = true;
foreach($optionValues_data as $optionValue)
{
	if($firstOption)
		$firstOption = false;
	else
		echo(", ");
	echo($optionValue->calculation_value ."=". $optionValue->name);
}

?>
<br/>Depth: 
<?php 
$firstOption = true;
foreach($masteryValues_data as $optionValue)
{
	if($firstOption)
		$firstOption = false;
	else
		echo(", ");
	echo($optionValue->calculation_value ."=". $optionValue->name);
}

?>
<br/>


<table>
	<tr>
		<th>Category</th>
		<th>Program Outcome</th>
		<th>Emphasis</th>
		<th>Depth</th>
	</tr>
	
<?php 
	//NumberFormat formatter = NumberFormat.getInstance();
	//formatter.setMaximumFractionDigits(1);
	$prevGroup = "";
	foreach($groups_data as $group)
	{

		$programOutcomes = $this->program_model->getProgramOutcomeForGroupAndProgram($programId,$group->id);
		$programOutcomes_data = $programOutcomes->result();
		$programOutcomes_count = $programOutcomes->num_rows();
		
		$first = true;
		?>
		<tr>
			<td rowspan="<?php echo $programOutcomes_count;?>"><?php echo $group->name;?></td>
		<?php 
		foreach($programOutcomes_data as $programOutcomeLink)
		{
			$programOutcomeTotalContribution = 0;
			$programOutcomeTotalMastery = 0;
			
			//ProgramOutcome programOutcome = programOutcomeLink.getProgramOutcome();
			if(!$first)
				echo("<tr>");
			else
				$first = false;
				
				
			?>																											  	
			<td><span title="<?php echo ($this->common->isValid($programOutcomeLink->po_description)?$programOutcomeLink->po_description:"No description");?>">
					<?php echo $programOutcomeLink->po_name;?>
                </span>
			</td>
			
            <td>
			<?php 
			$firstOffering = true;


			foreach($offeringsWithData_data as $offering)
			{
				$totalContribution = 0;
				foreach($contributionData_data as $contribution)
				{

					if($contribution->course_offering_id == $offering->course_offering_id)
					{
						if($contribution->link_program_program_outcome_id == $programOutcomeLink->program_outcome_id)
						{
							$totalContribution .= $contribution->cov_calculation_value;
						}
					}
				}
				if($firstOffering)
					$firstOffering = false;
				else
					echo(",");
				echo("<span title=\"section ".$offering->section_number . " (".$offering->term.")\">".$totalContribution."</span>");
				$programOutcomeTotalContribution .= $totalContribution;
				
			}
			?>
			(<?php echo ( (0.0 + $programOutcomeTotalContribution)/$offeringsWithData_count )?>)
			</td>
			<td>
			<?php 
			$firstOffering = true;
			foreach($offeringsWithData_data as $offering)
			{
				$totalContribution = 0;
				$totalMastery = 0;
				foreach($contributionData_data as $contribution)
				{
						
					if($contribution->course_offering_id == $offering->id)
					{
						if($contribution->link_program_program_outcome_id == $programOutcomeLink->program_outcome_id)
						{
							$totalMastery .= $contribution->mov_calculation_value;
						}
					}
				}
				if($firstOffering)
					$firstOffering = false;
				else
					echo(",");
				echo("<span title=\"section ".$offering->section_number . " (".$offering->term.")\">". $totalMastery."</span>");
				$programOutcomeTotalMastery .= $totalMastery;
				
			}
			?>
			(<?php echo (0.0 + $programOutcomeTotalMastery)/$offeringsWithData_count ?>)
			</td>
		</tr>
		<?php 
		
		}
	
	}?>
</table>
<hr/>
