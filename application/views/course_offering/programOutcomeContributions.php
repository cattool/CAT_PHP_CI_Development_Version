<h2>My Course Within this Program</h2>
<p>
This section is used to "map" your course to the overall program outcomes 
in your academic unit (previously identified as part of the curriculum development process).
 The first column lists the program outcome category and the second column describes the program outcome.
  In the column titled "Emphasis", select the extent of instructional emphasis your course places
   on that program outcome. In the final "Depth" column, select from the pull down menu the level of
    depth at which your course addresses that program outcome. For example, an introductory course
     related to a program outcome may specify a low amount of emphasis at an introductory depth.
</p>
<?php

$courseOfferingId = $this->input->get("course_offering_id");
//CourseManager cm = CourseManager.instance();
//OrganizationManager dm = OrganizationManager.instance();
$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
$courseOffering_data = $courseOffering->row();
$programId = $this->session->userdata("programId");
$programIdParameter = intval($this->input->get("program_id"));

if($programIdParameter > 0)
{
	$this->session->set_userdata("programId",$programIdParameter);
	$programId = $programIdParameter; 
}

echo("Currently selected Program :");
//List<Organization> organizations = cm.getOrganizationForCourseOffering(courseOffering);
//$organizations = $this->organization_model->getProgramOrderedByNameForOrganization($programId);
$organizations = $this->course_model->getOrganizationForCourseOffering($courseOffering_data->course_id);
$organizations_data = $organizations->result();
//List<Program> programs = new ArrayList<Program>();


$programs = array();
$bogus = array();
$bogus['id'] = -1;
$bogus['name'] = "Please select a Program";
array_push($programs,$bogus);


	foreach($organizations_data as $tempOrganizations){
			$programList = $this->program_model->getProgramByOrgId($tempOrganizations->organization_id);
			$programList_data = $programList->result();
			foreach($programList_data as $list){
				$bogus = array();
				$bogus['id'] = $list->id;
				$bogus['name']  = $list->name;
				array_push($programs,$bogus);
			}
	}


echo($this->common->createSelect("programToSet", $programs, "id", "name", $programId, "setProgramContributionId(".$courseOfferingId.")"));

if(!$this->common->isValid($programId))
{
	return;
}




//OutcomeManager om = OutcomeManager.instance();
//ProgramManager pm = ProgramManager.instance();

//Program program = pm.getProgramById(Integer.parseInt(programId));
$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();

//List<ProgramOutcomeGroup> groups = pm.getProgramOutcomeGroupsProgram(program);
$groups = $this->program_model->getProgramOutcomeGroupsProgram($program_data->id);
$groups_data = $groups->result();
$groups_count = $groups->num_rows();
//List<ContributionOptionValue> optionValues = pm.getContributionOptions();
$optionValues = $this->program_model->getContributionOptions();
$optionValues_data = $optionValues->result();
//List<MasteryOptionValue> masteryOptionValues = pm.getMasteryOptions();
$masteryOptionValues = $this->program_model->getMasteryOptions();
$masteryOptionValues_data = $masteryOptionValues->result();

if($groups_count < 1)
{
	echo("No Propram Outcomes found");
	return;
}
?>
<hr/>
<strong>Indicate below what is the instructional emphasis and depth for each of these outcomes in your course on the following scales.</strong>
  You also have the option to add information to the comment section appearing below the table.
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
foreach($masteryOptionValues_data as $optionValue)
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
		<th>Program Outcomes</th>
		<th>Emphasis</th>
		<th>Depth</th>
	</tr>
	
<?php

	$prevGroup = "";
	foreach($groups_data as $group)
	{
		//List<LinkProgramProgramOutcome> programOutcomes = pm.getProgramOutcomeForGroupAndProgram(program,group );
		$programOutcomes = $this->program_model->getProgramOutcomeForGroupAndProgram($programId,$group->id );
		$programOutcomes_data = $programOutcomes->result();
		$programOutcomes_count = $programOutcomes->num_rows();
		$first = true;
		?>
	<tr>
			<td rowspan="<?php echo $programOutcomes_count;?>"><?php echo $group->name;?></td>
		<?php
		foreach($programOutcomes_data as $programOutcomeLink)
		{
			//ProgramOutcome programOutcome = programOutcomeLink.getProgramOutcome();
			if(!$first)
				echo("<tr>");
			else
				$first = false;
			?>
			<td><span title="<?php echo $this->common->isValid($programOutcomeLink->po_description)?$programOutcomeLink->po_description:"No description"?>"><?php echo $programOutcomeLink->po_name?></span>
			</td>
			<td id="table_cell_<?php echo $programOutcomeLink->id?>">
			
			<?php
			//LinkCourseOfferingContributionProgramOutcome contributionLink = pm.getCourseOfferingContributionLinksForProgramOutcome(courseOffering, programOutcomeLink);
			$contributionLink = $this->program_model->getCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $programOutcomeLink->program_outcome_id);
			$contributionLink_data = $contributionLink->row();
			$contributionLink_count = $contributionLink->num_rows();
			if($contributionLink_count < 1)
			{
				$this->program_model->saveCourseOfferingContributionLinksForProgramOutcome($courseOffering_data->id, $programOutcomeLink->program_outcome_id, $optionValues_data[0]->id, $masteryOptionValues_data[0]->id);
				$contributionLink = $this->program_model->getCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $programOutcomeLink->program_outcome_id);
			}
			$optionValuesSelect = array();
			foreach($optionValues_data as $list){
				$bogus = array();
				$bogus['id'] = $list->id;
				$bogus['name']  = $list->name;
				array_push($optionValuesSelect,$bogus);
			}
			echo($this->common->createSelect("contribution".$programOutcomeLink->id, $optionValuesSelect, "id", "name", "".$contributionLink_data->contribution_option_id, "saveOfferingContribution(".$programOutcomeLink->id.",".$programId.",".$courseOfferingId.");"));
			echo("</td><td>");
			$masteryOptionValuesSelect = array();
			foreach($masteryOptionValues_data as $list){
				$bogus = array();
				$bogus['id'] = $list->id;
				$bogus['name']  = $list->name;
				array_push($masteryOptionValuesSelect,$bogus);
			}
			echo($this->common->createSelect("mastery".$programOutcomeLink->id, $masteryOptionValuesSelect, "id", "name", "".$contributionLink_data->mastery_option_id, "saveOfferingContribution(".$programOutcomeLink->id.",".$programId.",".$courseOfferingId.");"));
			
			?>
			</td>
			
		</tr>
		<?php
		}?>
	
	<?php } ?>
</table>
<hr/>
		<h3>Additional information:</h3>
		<br>
		<p>To add/edit additional information please click the edit icon below.
		</p>
	<div id="contributionComment">
		
	<?php echo !$this->common->isValid($courseOffering_data->contribution_comment)?"No additional information entered. Select edit icon below to add additional information.":$courseOffering_data->contribution_comment; ?>
	
</div>
<br/>
<a href="javascript:loadModify('<?php echo site_url();?>/courseOffering/editComments?course_offering_id=<?php echo $courseOfferingId;?>&type=contributionComment','contributionComment');" class="smaller">
	<img src="<?php echo base_url();?>/img/edit_16.gif" alt="Edit comments" title="Edit comments"></a>
