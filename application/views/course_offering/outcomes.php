	<?php

$courseOfferingId = $this->input->get("course_offering_id") ;


//CourseOffering courseOffering = new CourseOffering();
//CourseManager cm = CourseManager.instance();

/*
OrganizationManager dm = OrganizationManager.instance();
OutcomeManager om = OutcomeManager.instance();
*/

$access = true;
if($this->common->isValid($courseOfferingId))
{
	$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
	$courseOffering_data = $courseOffering->row();
}

$organizations = $this->course_model->getOrganizationForCourseOffering($courseOffering_data->course_id);
$organizations_data = $organizations->row();
$organizations_count = $organizations->num_rows();


//$organization = organizations.get(0);  

if($organizations_count < 1)
{
	?>
	<h1>Unable to find associated organization!</h1>
	<?php
	return;
}
else if($organizations_count > 1)
{	
?>
<h1>Course offering appears to be associated with multiple organizations! </h1>
<?php
	
}

//List<CharacteristicType> characteristicTypes = organization.getCharacteristicTypes();

$characteristicTypes = $this->organization_model->getOrganizationCharacteristicTypes($organizations_data->org_id);
$characteristicTypes_data  = $characteristicTypes->row();
$characteristicTypes_count = $characteristicTypes->num_rows();
if($characteristicTypes_count < 1)
{
	?>
	<h1>No Characteristics associated with organization <b><?php echo $organizations_data->org_name;?></b>!  Add Characteristics first please!</h1>
	<?php
	return;
}
$maxOutcomes = 20;
?>
<h2>My Course Learning Outcomes</h2>
<p>This section gathers information about your goals for the course, 
specifically those abilities, knowledge, and values for which you anticipate
 evidence of in students as they complete your course. 
 You may enter up to <?php echo $maxOutcomes;?> course learning outcomes one-at-a time by clicking on <i><b>add course learning outcome</b></i> to add each entry.
Each entry may contain no more than 400 characters (less than 10 outcomes recommended). 
To change the order of the course learning outcomes, use the arrows to the left of each outcome
</p>

<div>
	<div id="mainCourseOfferingCharacteristics">
		<table border="1" cellpadding="5" cellspacing="0">
<?php
$count = 1;
$outcomes = $this->outcome_model->getOutcomesForCourseOffering($courseOfferingId);
$outcomes_count = $outcomes->num_rows();
$outcomes_data = $outcomes->result();
$lastOne = $outcomes_count - 1;

foreach($outcomes_data as $o)
{
	
	// missing table: link_program_characteristic_type

	/*$outcomeCharacteristics = $this->outcome_model->getCharacteristicsForCourseOfferingOutcome(courseOffering,o, organization);
	StringBuilder charOutput = new StringBuilder();
	int charTypeIndex = 0;
	int colorIndex = 0;
	for(Characteristic charac: outcomeCharacteristics)
	{
		CharacteristicType cType = charac.getCharacteristicType();
		if(cType.getQuestionDisplay().length() > 0)
		{
			if(cType.getQuestionDisplay().length()>0)
			{
				charOutput.append(cType.getQuestionDisplay());	
			}
			charOutput.append(" ");
			charOutput.append(charac.getName());
			charOutput.append("      ");
		}
		
	}*/
	$charOutput = "";
	$charOutputDisplay = "";
	if(strlen($charOutput) > 0)
		$charOutputDisplay = " title=\"" . $charOutput ."\"";
	
	?>
	<tr>
	    <td><?php echo $count;?></td>
	    <td>
	    <?php if($count>1)
		{?>
			<a href="javascript:moveOutcome(<?php echo $o->course_outcome_id;?>,<?php echo $courseOfferingId;?>,'up');">
				<img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/>
			</a>
		<?php }
		if($count <= $lastOne)
		{?>
			<a href="javascript:moveOutcome(<?php echo $o->course_outcome_id;?>,<?php echo $courseOfferingId;?>,'down');">
				<img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/>
			</a>
		<?php }
		?>
	    </td>
	    <td <?php echo $charOutputDisplay;?>><?php echo $o->name;?>	
	    <?php if($access)
		  {?>	
				<a href="javascript:loadModify('../course_offering/addOutcome?outcome_id=<?php echo $o->course_outcome_id;?>&organization_id=<?php echo $organizations_data->org_id;?>&course_offering_id=<?php echo $courseOfferingId;?>');" class="smaller">
                	<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit outcome" title="Edit outcome">
                </a>
				<a href="javascript:removeCourseOfferingOutcome(<?php echo $courseOfferingId;?>,<?php echo $o->course_outcome_id;?>);"><img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove outcome" title="Remove outcome"/></a>
          <?php
		  } ?>
		</td>
	</tr>
	<?php 
	$count++;
}

if($access)
{
	if($count <= $maxOutcomes)

	{
	?>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2"><a href="javascript:loadModify('<?php echo site_url();?>/course_offering/addOutcome?organization_id=<?php echo $organizations_data->org_id;?>&course_offering_id=<?php echo $courseOfferingId;?>');" class="smaller">
				<img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add course outcome" title="Add course outcome"/>
				add course learning outcome 
			</a>
		    </td>
		</tr>
	<?php }
	else
	{
		?>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">Maximum of <?php echo $maxOutcomes;?> has been reached.
		    </td>
		</tr>
	<?php }
}
?>
 </table>
</div>
<div id="characteristicsModifyDiv" class="fake-input" style="display:none;">
</div>
</div>
<?php 
function getStars($value, $max)
{
	$yellow = "<img src=\"/".base_url()."cat/images/yellow_star.png\">";
	$white =  "<img src=\"/".base_url()."cat/images/white_star.png\">";
	
	$r = '';
	for($i=1; $i <= $value ; $i++)
		$r .= $yellow;
	for($i=$value+1; $i <= $max ; $i++)
		$r .= $white;
	return $r;
}
$tempColourValues = "0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,F,E,D,C,B,A,9,8,7,6,5,4,3,2,1,0";
$colourValues=explode(',',$tempColourValues);
function getColour($type, $level, $maxLevel)
{
	$colourLevel = 14;
	if($level <= 1)
	{
		$colourLevel = 0;
	}
	else if($maxLevel > $level)
	{
		$level = $level - 1;
		$maxLevel--;
		$ratio = ($level *1.0 )/$maxLevel;
		$colourLevel = ($ratio * 16);
	}
	if($colourLevel < 0)
		$colourLevel = 0;
	else if($colourLevel >14)
		$colourLevel = 14;
	
	$levelChar = $colourValues[$colourLevel];
	if($type == 0)
	{
		return "F" . $levelChar . $levelChar;
	}
	else if($type == 1)
	{
		return $levelChar . "F" . $levelChar;
	}
	else if($type == 2)
	{
		return $levelChar . $levelChar . "F";
	}
	else if($type == 3)
	{
		return $levelChar . "FF";
	}
	else if($type == 4)
	{
		return "F" . $levelChar . "F";
	}
	else if($type == 5)
	{
		return "FF" . $levelChar;
	}
	return "000";
}

?>
 