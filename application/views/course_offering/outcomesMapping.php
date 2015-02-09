<h2>My Course Outcomes in Relation to Program Outcomes</h2>
<p>
	<ul>
		<li>This section offers a more detailed view of your course in the context of program outcomes 
		by providing the opportunity to "map" your course learning outcomes to the overall program outcomes that have been 
		predetermined in the academic unit as part of the curriculum development process.
		 Each course learning outcomes will often align with at least one of the program outcomes, 
		 although a course may have an unique learning outcome that is not articulated as a program outcome.
		 Both aligned and distinct course learning outcomes are valuable for students, 
		 instructors, and the program's curriculum planning process. 
		</li> 
		<li>The first column lists the program outcome category, the second column the program outcome description.
		</li>
		 <li>To remove a learning outcome row, select "remove" in the outcome pull down menu.
		 </li>
	</ul>
</p>

<?php

$courseOfferingId = intval($this->input->get("course_offering_id"));
//CourseManager cm = CourseManager.instance();
$courseOffering = $this->course_model->getCourseOfferingById($courseOfferingId);
$courseOffering_data = $courseOffering->row();
//OrganizationManager dm = OrganizationManager.instance();
$programId = $this->session->userdata("programId");
$programIdParameter = intval($this->input->get("program_id"));
if($programIdParameter > 0)
{
	$this->session->set_userdata("programId",$programIdParameter);
	$programId = $programIdParameter; 
}

echo("Currently selected Program :");
$organizations = $this->course_model->getOrganizationForCourseOffering($courseOffering_data->course_id);
$organizations_data = $organizations->result();
$programs = array();
$bogus = array();
$bogus['id'] = -1;
$bogus['name'] = "Please select a Program";
//programs.add(bogus);
array_push($programs,$bogus);
//print_r($organizations_data);

foreach($organizations_data as $dep)
{
	$tempProgram = $this->program_model->getProgramByOrgId($dep->organization_id);
	$tempProgram_data = $tempProgram->row();
	$bogus = array();
	$bogus['id'] = $tempProgram_data->id;
	$bogus['name'] = $tempProgram_data->name;
	array_push($programs,$bogus);
	
	//programs.addAll(dm.getProgramOrderedByNameForOrganization(dep));
	
}
echo($this->common->createSelect("programToSet", $programs, "id", "name", $programId, "setProgramId(".$courseOfferingId.")"));

if(!$this->common->isValid($programId))
{
	return;
}

//OutcomeManager om = OutcomeManager.instance();
$outcomes = $this->outcome_model->getOutcomesForCourseOffering($courseOfferingId);
$outcomes_data = $outcomes->row();

$access = true;
//ProgramManager pm = ProgramManager.instance();

$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();
$groups = $this->program_model->getProgramOutcomeGroupsProgram($programId);
$groups_count = $groups->num_rows();
$groups_data = $groups->result();
if($groups_count < 1)
{
	echo ("No Propgram Outcomes found");
	return;
}
?>
<table>
	<tr>
		<th>Category</th>
		<th>Program Outcome</th>
		<th>Your Course Outcomes</th>
	</tr>
	
<?php

$this->session->set_userdata("courseOutcomes",$outcomes_data);
$this->session->set_userdata("courseOffering",$courseOffering_data);
	$prevGroup = "";
	//echo '<hr/>';
	//print_r($groups_data);

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
		//print_r($programOutcomes_data);
		foreach($programOutcomes_data as $programOutcomeLink)
		{
			//ProgramOutcome programOutcome = programOutcomeLink.getProgramOutcome();
			if(!$first)
				echo ("<tr>");
			else
				$first = false;
			?>
			<td><span title="<?php echo $this->common->isValid($programOutcomeLink->po_description)?$programOutcomeLink->po_description():"No description"?>">
            	<?php echo $programOutcomeLink->po_name;?></span>
				</td>
				<td>
			<?php
			$links = $this->program_model->getCourseOutcomeLinksForProgramOutcome($courseOfferingId, $programOutcomeLink->po_id);
			$alreadyLinked = "";
			
			?>
			<table id="programOutcomeContributions_<?php echo $courseOffering_data->id;?>_<?php echo $programOutcomeLink->id;?>" style="margin:0px;">
				<?php /*            
				<jsp:include page="courseOutcomeContributions.jsp">
					<jsp:param name="course_offering_id" value="<%=courseOffering.getId()%>" />
					<jsp:param name="program_outcome_id" value="<%=programOutcome.getId()%>" />
				</jsp:include>
					*/
					$data['course_offering_id'] = $courseOffering_data->id;
					$data['program_outcome_id'] = $programOutcomeLink->id;
					$this->load->view('course_offering/courseOutcomeContributions',$data);
				?>	
			</table>
			
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
	<div id="outcomeComment">
		
	<?php !$this->common->isValid($courseOffering_data->comments)?"No additional information entered. Select edit icon below to add additional information.":$courseOffering_data->comments;?>
	
</div>
<br/>
<a href="javascript:loadModify('<?php echo site_url();?>course_offering/editComments?course_offering_id=<?php echo $courseOfferingId;?>&type=outcomeComment','outcomeComment');" class="smaller">
	<img src="<?php echo base_url()?>/img/edit_16.gif" alt="Edit comments" title="Edit comments">
</a>
