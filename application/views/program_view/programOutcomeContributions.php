<?php
$courseId = $this->input->get("course_id");
$programId = $this->input->get("program_id");
//CourseManager cm = CourseManager.instance();
//Course course = cm.getCourseById(Integer.parseInt(courseId));
$course = $this->course_model->getCourseById(intval($courseId));
$course_data = $course->row();
/*List<CourseOffering> offerings = (List<CourseOffering>)cm.getCourseOfferingsForCourse(course);
List<String> terms = cm.getAvailableTermsForCourse(course);*/

$offerings = $this->course_model->getCourseOfferingsForCourse($courseId);
$offerings_data = $offerings->result();
$terms = $this->course_model->getAvailableTermsForCourse($courseId);
$terms_data = $terms->result();

$sessionValue = $this->session->userdata("userIsSysadmin");
$sysadmin = !is_null($sessionValue) && $sessionValue;
$access = $sysadmin;
if($this->common->isValid($programId))
{
	$organization = $this->program_model->getOrganizationByProgramId($programId);	
	$organization_data = $organization->row();
	//@SuppressWarnings("unchecked")
	//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	
	$access = $sysadmin || !is_null($userHasAccessToOrganizations) && $userHasAccessToOrganizations_count > 0;
	
	
}

//OutcomeManager om = OutcomeManager.instance();
//ProgramManager pm = ProgramManager.instance();

$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->result();
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
?>
<hr/>
<strong>Indicate below what is the instructional emphasis and depth for each of these outcomes in your course on the following scales.</strong>
<br/>Emphasis:
<?php 
$firstOption = true;
foreach( $optionValues_data as $optionValue)
{
	if($firstOption)
		$firstOption = false;
	else
		echo(", ");
	echo($optionValue->calculation_value ."=". $optionValue->name);
}

?>
<br/>
<br/>Depth: 
<?php 

foreach( $masteryValues_data as $optionValue)
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
	$prevGroup = "";
	foreach($groups_data as $group)
	{
		$programOutcomes = $this->program_model->getProgramOutcomeForGroupAndProgram($programId,$group->id );
		$programOutcomes_count = $programOutcomes->num_rows();
		$programOutcomes_data = $programOutcomes->result();
		$first = true;
		?>
	<tr>
			<td rowspan="<?php echo $programOutcomes_count;?>"><?php echo $group->name;?></td>
		<?php 
		foreach($programOutcomes_data as $programOutcomeLink)
		{
			$programOutcome = $programOutcomeLink->program_outcome_id;
			if(!$first)
				echo("<tr>");
			else
				$first = false;
			?>
			<td><span title="<?php echo $this->common->isValid($programOutcomeLink->po_description)?$programOutcomeLink->po_description:"No description"?>">
				<?php echo $programOutcomeLink->po_name;?></span>
			</td>
			<td id="table_cell_<?php echo $programOutcomeLink->id?>">
			
			<?php 
			//LinkCourseContributionProgramOutcome contributionLink = pm.getCourseContributionLinksForProgramOutcome(course, programOutcomeLink);
			$contributionLink = $this->program_model->getCourseContributionLinksForProgramOutcome($courseId, $programOutcomeLink->id);
			$contributionLink_count  = $contributionLink->num_rows();
			$contributionLink_data = $contributionLink->row();
			if(intval($contributionLink_count) < 1)
			{
				$this->program_model->saveCourseContributionLinksForProgramOutcome($courseId, $programOutcomeLink->id, $optionValues_data[0]->id,$masteryValues_data[0]->id);
				$contributionLink = $this->program_model->getCourseContributionLinksForProgramOutcome($courseId, $programOutcomeLink->id);
			}
			if($access)
			{
				 $optionValuesSelect = array();
				 foreach($optionValues_data as $tempoptionValues){
						$bogus = array();
						$bogus['id'] = $tempoptionValues->id;
						$bogus['name'] = $tempoptionValues->name;
						array_push($optionValuesSelect,$bogus);
				  }	
				
				 $masteryValuesSelect = array();
				 foreach($optionValues_data as $tempmasteryValues){
						$bogus = array();
						$bogus['id'] = $tempmasteryValues->id;
						$bogus['name'] = $tempmasteryValues->name;
						array_push($masteryValuesSelect,$bogus);
				  }	
				?>
				<?php echo $this->common->createSelect("contribution".$programOutcomeLink->id, $optionValuesSelect, "id", "name", $contributionLink_data->contribution_option_id, "saveContribution(".$programOutcomeLink->id.",".$programId.",".$courseId.");")?>
				</td>
				<td>
				<?php echo $this->common->createSelect("mastery".$programOutcomeLink->id, $masteryValuesSelect, "id", "name", "".$contributionLink_data->mastery_option_id, "saveContribution(".$programOutcomeLink->id.",".$programId.",".$courseId.");")?>
				<?php 
				
			}
			else
			{
				echo($contributionLink_data->cov_calculation_value);
				echo("</td><td>"); 
				echo($contributionLink_data->mov_calculation_value);
			}
			?>
			</td>
		</tr>
		<?php 
		}?>
	
	<?php }?>
</table>
<hr/>
