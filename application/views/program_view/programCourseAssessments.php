<?php
$courseIds = $this->input->get("course_id");
$courseIdList = array();
if(!is_null($courseIds) && strlen($courseIds) > 0)
	$courseIdList = $courseIds;

$programId = $this->input->get("program_id");
$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;


//Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
//boolean sysadmin = sessionValue != null && sessionValue;
//@SuppressWarnings("unchecked")
//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
//boolean access = sysadmin;


if($this->common->isValid($programId))
{
	//Organization organization = OrganizationManager.instance().getOrganizationByProgramId(programId);	
	//access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+organization.getId());
	$organization = $this->program_model->getOrganizationByProgramId($programId);
	$organization_data = $organization->row();
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($organization_data->organization_id,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	$access = $sysadmin || $userHasAccessToOrganizations_count > 0;
}
if(!$access)
{
		echo("Access denied!");
		return;
}
//ProgramManager pm = ProgramManager.instance();

$o = $this->program_model->getProgramById(intval($programId));
$o_data = $o->row();
//CourseManager cm = CourseManager.instance();
$timeOptionsList = $this->course_model->getAssessmentTimeOptions();
$timeOptionsList_count = $timeOptionsList->num_rows();
$timeOptionsList_data = $timeOptionsList->result();
$maxOptionIndex = 0;
$ongoingOptionIndex = -1;
$numTimePeriods = 0;
/*for($i = 0 ; $i < $timeOptionsList_count; $i++)
{	
	AssessmentTimeOption options = timeOptionsList.get(i);
	if(options.getDisplayIndex() > maxOptionIndex)
		maxOptionIndex = options.getDisplayIndex();
	if(options.getTimePeriod().equalsIgnoreCase("O"))
	{// this is an ongoing type, ditribute over all time-periods 
		ongoingOptionIndex = i;
		
	}
	else if (options.getTimePeriod().equalsIgnoreCase("Y"))
		numTimePeriods++;
}*/
$ictr = 0;
foreach($timeOptionsList_data as $timeOption){
	
	if($timeOption->display_index > $maxOptionIndex)
		$maxOptionIndex = $timeOption->display_index;
	if(strtoupper($timeOption->time_period) == 'O')
		$ongoingOptionIndex = $ictr;		
$ictr++;		
}


//@SuppressWarnings("unchecked")
//HashMap<String, ArrayList<Double>>  organizedData = (HashMap<String, ArrayList<Double>>)session.getAttribute("organizedData");
$organizedData = '';
if(strlen($this->session->userdata("organizedData")) > 0){
	$organizedData = $this->session->userdata("organizedData");
}
if($this->common->isValid($organizedData))
{
	$assessmentData = $this->program_model->getProgramCourseAssessmentOptions($programId, array());
	$assessmentData_data = $assessmentData->result();
	$offeringCounts = $this->program_model->getCourseOfferingCounts($programId, array());
	$offeringCounts_data = $this->result();
	$organizedData = pm.organizeAssessmentData(assessmentData, maxOptionIndex, offeringCounts);
	$organizedData_data = $this->result();
}
/*
StringBuilder columnNames = new StringBuilder();
StringBuilder values = new StringBuilder();
*/
$columnNames = array();
$values = array();

$first = true;
$numOptions = 0;
foreach($timeOptionsList_data as $timeOption)
{
	if(strtoupper($timeOption->time_period) != "O")
	{
		if($first)
			$first = false;
		else
			array_push($columnNames,",");
			//columnNames.append(",");
	
		//columnNames.append(timeOption.getName());
		array_push($columnNames,$timeOption->name);
		$numOptions++;
	}
}
$courseLinks =$this->program_model->getLinkCourseProgramForProgram($programId);
$courseLinks_data = $courseLinks->result();
//HashMap<String,StringBuilder> required = new HashMap<String, StringBuilder>();
//HashMap<String,StringBuilder> elective = new HashMap<String, StringBuilder>();
$required = array();
$elective = array();

//String[] years = {"100-level", "200-level", "300-level" , "400-level","500-level","800-level", "900-level"};
//String[] yearCodes = {"firstYear", "secondYear", "thirdYear" , "fourthYear","500-level","800-level", "900-level"};
$years = array();
array_push($years,"100-level", "200-level", "300-level" , "400-level","500-level","800-level", "900-level");
$yearCodes = array();
array_push($yearCodes,"firstYear", "secondYear", "thirdYear" , "fourthYear","500-level","800-level", "900-level");


$courses1 = '';
$courses2 = '';

foreach($yearCodes as $year => $yearValue)
{
	$courses1 = '';
	//StringBuilder courses1 = /*new StringBuilder()*/;
	//StringBuilder courses2 = new StringBuilder();
	//required.put(year,courses1);

	$required[$yearValue] = $courses1;
	//elective.put(year,courses2);
 	$elective[$yearValue] = $courses2;
	

	$ictr++;
	
}

//print_r($courseLinks_data);


foreach($courseLinks_data as $courseLink)
{
	$c = $courseLink->course_id;
	$classification = $courseLink->course_classification_id;
	//echo("Course="+c.getCourseNumber() + "index="+ ((c.getCourseNumber()/100) -1) +" "+classification.getName());
	$index = (intval($courseLink->c_course_number)/100) -1;
	if ($index > 4) // 800 or 900
		$index -= 2;
		

	$index = round($index,0);


	if(strtoupper($courseLink->cc_name) == "REQUIRED")
	{
		if($index < count($yearCodes))
		{
			$toAddTo = $required[$yearCodes[$index]];
			$toAddTo .= "<input type=\"checkbox\" class=\"course ";
			$toAddTo .= $yearCodes[$index];
			$toAddTo .= " required\"  value=\"";
			$toAddTo .= $c;
			$toAddTo .= "\" onclick=\"gatherAssessmentData(";
			$toAddTo .= $programId;
			$toAddTo .= ",this);\">";
			$toAddTo .= $courseLink->c_subject;
			$toAddTo .= " ";
			$toAddTo .= $courseLink->c_course_number;
			$toAddTo .= "<br>\n";
		}

	}
	else
	{
		if($index < count($yearCodes))
		{
			$toAddTo = $elective[$yearCodes[$index]];
			$toAddTo .= "<input type=\"checkbox\" class=\"course ";
			$toAddTo .= $yearCodes[$index];
			$toAddTo .= " elective\" value=\"";
			$toAddTo .= $c;
			$toAddTo .= "\" onclick=\"gatherAssessmentData(";
			$toAddTo .= $programId;
			$toAddTo .= ",this);\">";
			$toAddTo .= $courseLink->c_subject;
			$toAddTo .= " ";
			$toAddTo .= $courseLink->c_course_number;
			$toAddTo .= "<br>\n";
		}
	}
	
}

$current = "required";
?>
<table id="uofs_table">
	<tr>
    	<th colspan="7">
        	<input class="course" type="checkbox" id="<?php echo $current?>" value=".<?php echo $current?>" onclick="gatherAssessmentData(<?php echo $programId?>,this);">All <?php echo $current?> Courses
        </th>
    </tr>
	<tr class="required">
<?php for($i = 0; $i< count($yearCodes); $i++)
{?>
	<th>
    	<input type="checkbox" class="course <?php echo $current?>" id="<?php echo $yearCodes[$i]?>" value=".<?php echo $yearCodes[$i]?>.<?php echo $current?>" onclick="gatherAssessmentData(<?php echo $programId?>,this);"><?php echo $years[$i]?>
    </th>
<?php 
}
?>	</tr>
	<tr>
<?php 
for($i = 0; $i< count($yearCodes); $i++)
{
?>	

	<td>
		<?php echo $required[$yearCodes[$i]]?>
	</td>
<?php }
$current="elective";

?>
</tr>
</table>
<br><br>
<table>
<tr><th colspan="7"><input class="course" type="checkbox" id="<?php echo $current?>" value=".<?php echo $current?>" onclick="gatherAssessmentData(<?php echo $programId?>,this);">All elective or optional Courses</th></tr>
<tr class="required">
<?php for($i = 0; $i< count($yearCodes); $i++)
{?>
	<th><input type="checkbox" class="course <?php echo $current?>" id="<?php echo $yearCodes[$i]?>" value=".<?php echo $yearCodes[$i]?>.<?php echo $current?>" onclick="gatherAssessmentData(<?php echo $programId?>,this);"><?php echo $years[$i]?></th>
<?php 
}
?></tr>
<tr>
<?php 
for($i = 0; $i< count($yearCodes); $i++)
{
?>	

	<td>
		<?php echo $elective[$yearCodes[$i]];?>
	</td>
<?php }
//long time = System.currentTimeMillis();
$time = round(microtime(true) * 1000);
?>
</tr>
</table>
<table>
	<tr><td><div id="summaryAssessmentDiv" style="width:550px;height:300px;">
		<img src="program_view/programCourseAssessmentData?program_id=<?php echo $programId?>&time=<?php echo $time?>" style="width:550px;height:300px;"></img>
	</div></td>
		<td>
	<div id="summaryTeachingMethodsDiv"  style="width:550px;height:300px;">
		<img src="program_view/programCourseTeachingMethodData?program_id=<?php echo $programId?>&time=<?php echo $time?>" style="width:550px;height:300px;"></img>
	</div></td>
		</tr>
	<tr><td><div id="summaryAssessmentGroupsDiv" style="width:550px;height:300px;">
		<img src="program_view/programAssessmentGroups?program_id=<?php echo $programId?>&time=<?php echo $time?>" style="width:550px;height:300px;"></img>
	</div></td>
	
		<td>&nbsp;
		
		</td>
		</tr>
		
</table>
