<?php
$programId = $this->input->get("program_id");
$terms = $this->input->get("term");
//List<String> termList = new ArrayList<String>();
$termList = array();
if(is_null($terms) && strlen($terms) > 0)
	$termList = $terms;
//CourseManager cm = CourseManager.instance();
//ProgramManager pm = ProgramManager.instance();

$program = $this->program_model->getProgramById(intval($programId));
$program_data = $program->row();
$courseLinks = $this->program_model->getLinkCourseProgramForProgram($program_data->id);

$contributingCourses = $this->program_model->getCourseOfferingsContributingToProgram($programId, $termList);
$contributingCourses_count = $contributingCourses->num_rows();
$groups = $this->program_model->getProgramOutcomeGroupsProgram($programId);
$groups_data = $groups->result();
$optionValues = $this->program_model->getContributionOptions();
$optionValues_data = $optionValues->result();
$masteryValues = $this->program_model->getMasteryOptions();
$masteryValues_data = $masteryValues->result();

if(empty($termList))
{
	echo("No Term(s) selected");
	return;
}

if(empty($groups))
{
	echo("No Program Outcomes found");
	return;
}
if(empty($courseLinks))
{
	echo("No Courses linked to Program");
	return;
}
?>
<hr/>

<br>
<strong>Indicated below is the instructional emphasis and depth for each of these outcomes in your course on the following scales</strong>
<br/><b>Emphasis:</b>
<?php
$firstOption = true;
foreach($optionValues_data as $optionValue)
{
	if($firstOption)
		$firstOption = false;
	else
		echo(", ");
	echo($optionValue->calculation_value ."=". $optionValue->name);
}?>
<br/><b>Depth:</b>
<?php
$firstOption = true;
foreach($masteryValues_data as $optionValue)
{
	if($firstOption)
		$firstOption = false;
	else
		echo(", ");
	echo($optionValue->calculation_value ."=". $optionValue->name);
}?>
<br/>

<table>
	<tr>
		<th>Category</th>
		<th>Program Outcome</th>
		<th style="width:100px;">Course</th>
		<th style="width:50px;">Emphasis</th>
		<th style="width:50px;">Depth</th>
	</tr>
	
<?php
	//NumberFormat formatter = NumberFormat.getInstance();
	//formatter.setMaximumFractionDigits(2);
	$prevGroup = "";
	foreach($groups_data as $groups)
	{

		$programOutcomes = $this->program_model->getProgramOutcomeForGroupAndProgram($programId,$groups->id);
		$programOutcomes_count = $programOutcomes->num_rows();
		$programOutcomes_data = $programOutcomes->result();
		$first = true;
		?>
		<tr>
			<td rowspan="<?php echo $programOutcomes_count;?>"><?php echo $groups->name;?></td>
		<?php
		foreach($programOutcomes_data as $programOutcomeLink)
		{
			$programOutcomeTotal = 0;
			$programOutcome = $programOutcomeLink->program_outcome_id;
			if(!$first)
				echo("<tr>");
			else
				$first = false;
			?>
			<td><span title="<?php if($this->common->isValid($programOutcome->po_description)){ echo $programOutcome->po_description;}else{ echo "No description"; }?>">
            	<?php echo $programOutcome->po_name;?></span>
			</td>
			<td colspan="3">
				<table style="border-bottom:0px; border-top:0px; margin:0px;">
					<?php 
					$contributions = $this->program_model->getContributionForProgramOutcome($programOutcomeLink->id,$programId,$termList);
					$contributions_data = $contributions->result();
					$serviceContributions = $this->program_model->getServiceCourseContributionForProgramOutomce($programOutcomeLink->id, $programId);
					$serviceContributions_data = $serviceContributions->result();
					$extentContributions =  array();//new TreeMap<String,String>();
					$masteryContributions =  array();//new TreeMap<String,String>();
					$masterCourseList = array();//new ArrayList<String>();
					foreach($contributions_data as $contribution)
					{
						$offering = $this->course_model->CourseOfferingById($contribution->courseOfferingId);
						$offering_data = $offering->row();
						$course = $offering->course_id;
						$display = $contribution->subject . " " . $contribution->course_number;
						
						foreach($masterCourseList as $key=>$value){
								if($display != $value){
									array_push($masterCourseList,$display);
								}
						}
						/*
						if (!masterCourseList.contains(display))
						{
							masterCourseList.add(display);
						}*/
						$extentValue = $extentContributions[$display];
						if($this->common->isValid($extentValue))
						{
							$extentValue = "" . $contribution->contributionObject;
						}
						else
						{
							$extentValue = "" . ( intval($extentValue) . $contribution->contibutionObject);
						}
						//extentContributions.put(display, extentValue);
						$extentContributions->$display = $extentValue;
						//String masteryValue = masteryContributions.get(display);
						$masteryValue = $masteryContributions[$display];
						if($this->common->isValid($masteryValue))
						{
							$masteryValue = "".$contribution->masteryObject;
						}
						else
						{
							$masteryValue = "".intval($masteryValue) . $contribution->masteryObject;
						}
						//masteryContributions.put(display, masteryValue);
						$masteryContributions->$display = $masteryValue;
					}
					foreach($serviceContributions_data as $contribution )
					{
						$course = $this->course_model->getCourseById($contribution->CourseOfferingId);
						$course_data = $course->row();
						$display = $course_data->subject . " " . $course_data->course_number;
						
						foreach($masterCourseList as $key=>$value){
								if($display != $value){
									array_push($masterCourseList,$display);
								}
						}
						/*
						if (!masterCourseList.contains(display))
						{
							masterCourseList.add(display);
						}
						*/
						$extentValue = $extentContributions[$display];
						if(!$this->common->isValid($extentValue))
						{
							$extentValue = "".$contribution->contributionObject;
						}
						else
						{
							$extentValue = "" . intval($extentValue) . $contribution->contributionObject;
						}
						//extentContributions.put(display, extentValue);
						$extentContributions->$display = $extentValue;
						//String masteryValue = masteryContributions.get(display);
						$masteryValue = $masteryContributions[$display];
						if(!$this->common->isValid($masteryValue))
						{
							$masteryValue = "".$contribution->masteryObject;
						}
						else
						{
							$masteryValue = "".  intval($masteryValue) . $contribution->masteryObject;
						}
						//masteryContributions.put(display, masteryValue);
						$masteryContributions->$display = $masteryValue;
					}
					//Arrays.sort(masterCourseList.toArray());
					asort($masterCourseList);
					foreach($masterCourseList as $course)
					{
						$extentDisplay = "";
						$masteryDisplay = "";
						$extentValue = $extentContributions[$course];
						$masteryValue = $masteryContributions[$course];
						$offeringCount = $contributingCourses[$course];
						if(is_null($offeringCount))
						{
							if(is_null($extentValue)){
								$extentDisplay = "0";
							}else{
								$extentDisplay = $extentValue;
							}
							if(is_null($masteryValue)){
								$masteryDisplay = "0";
							}else{
								$masteryDisplay = $masteryValue;	
							}
							//extentDisplay = extentValue==null?"0":extentValue;
							//masteryDisplay = masteryValue==null?"0":masteryValue;	
						}
						else
						{
							//extentDisplay = extentValue==null?"0": ""+ formatter.format(((0.0 +Integer.parseInt(extentValue))/offeringCount));
							//masteryDisplay = masteryValue==null?"0": "" + formatter.format(((0.0 + Integer.parseInt(masteryValue))/offeringCount));	
							if(is_null($extentValue)){
								$extentDisplay = "0";
							}else{
								$extentDisplay = ((0.0 + intval($extentValue))/$offeringCount);
							}
							
							if(is_null($masteryValue)){
								$masteryDisplay = "0";
							}else{
								$masteryDisplay = ((0.0 + intval($masteryValue))/$offeringCount);
							}
						}
						?>
						<tr><td style="border-bottom:0px; border-top:0px;width:100px;"><?php echo $course;?></td> 
						    <td  style="border-bottom:0px; border-top:0px;width:50px;"><?php echo $extentDisplay;?></td>
						
						    <td style="border-bottom:0px; border-top:0px;width:50px;"> <?php echo $masteryDisplay;?> </td>
						</tr>
						<?php
					}
					?>
				</table>
		</tr>
		<?php
		}
	
	}
	
	?>
</table>
<hr/>
