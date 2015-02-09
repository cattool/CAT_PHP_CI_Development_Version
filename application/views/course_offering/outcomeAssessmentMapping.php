<?php

$organizationId = $this->input->get("organization_id") ;
$courseOfferingId = $this->input->get("course_offering_id") ;

/*
@SuppressWarnings("unchecked")
HashMap<String,CourseOffering> userHasAccessToOfferings = (HashMap<String,CourseOffering>)session.getAttribute("userHasAccessToOfferings");

Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
boolean sysadmin = sessionValue != null && sessionValue;
boolean access = sysadmin || (userHasAccessToOfferings!=null && userHasAccessToOfferings.containsKey(courseOfferingId));
*/

$userHasAccessToOfferings = $this->session->userdata('userHasAccessToOfferings');
$containsKeyOffering = 0;
if(!is_null($userHasAccessToOfferings) && strlen($userHasAccessToOfferings) > 0){
	foreach($userHasAccessToOfferings as $row=>$id){
		if($row === $courseOfferingId)
			$containsKeyOffering = 1;	
	}
}

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin || !is_null($userHasAccessToOfferings) && $containsKeyOffering;



//CourseManager cm = CourseManager.instance();
//OutcomeManager om = OutcomeManager.instance();
$courseOffering = null;
$dummyCourseId = 0;
if($this->common->isValid($courseOfferingId))
{
	$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
	$courseOffering_data = $courseOffering->row();
	$dummyCourseId = $courseOffering_data->id;
	
}


$outcomes = $this->outcome_model->getOutcomesForCourseOffering($dummyCourseId);
$outcomes_data = $outcomes->result();
$list = $this->course_model->getAssessmentsForCourseOffering($dummyCourseId);
$list_data = $list->result();
$existingLinks = $this->outcome_model->getLinkAssessmentCourseOutcomes(intval($courseOfferingId));
$existingLinks_data = $existingLinks->result();
//NumberFormat formatter = NumberFormat.getInstance();
//formatter.setMaximumFractionDigits(1);
?>
<h2>How I Assess for My Course Learning Outcomes</h2>
<p>
This section gathers information on how your course learning outcomes are being assessed 
including any alignment between your goals for students' learning and how they demonstrate that learning.
<br/>
To link a course learning outcome to an assessment, select one of your course learning outcomes from the
 drop-down menu and then in the same row select the relevant assessment. Click "Add". 
Repeat using both drop-down menus for additional entries, including for matching multiple assessments with a single outcome.
 
 
 
 
</p>
<div>
	<table cellpadding="0" cellspacing="0" border="1">
		<tr><th>Course Learning Outcome</th><th>Assessed By:</th></tr>
		<?php

		foreach($existingLinks_data as $outcomeLink)
		{
			
			//CourseOutcome outcome = outcomeLink.getOutcome();
			$displayIndex = $this->outcome_model->getCourseOutcomeIndex($outcomes_data, $outcomeLink->course_outcome_id);
			//LinkCourseOfferingAssessment link = outcomeLink.getAssessmentLink();
			$additionalInfo = $outcomeLink->additional_info;
			$group = $outcomeLink->assessment_group_id;
			//AssessmentGroup group = link.getAssessment().getGroup();
			$infoDisplay = "";
		
			
			if(!is_null($outcomeLink->assessment_group_id))
				$infoDisplay = $outcomeLink->short_name. ": ";
			
			$infoDisplay .= $outcomeLink->assessment_name . ($this->common->isValid($additionalInfo)?" ( ".$additionalInfo." )":"");
			?>
		<tr>
			<td><?php echo($displayIndex)?> <?php echo $outcomeLink->co_name;?></td><td><?php echo $infoDisplay;?>, <?php echo number_format($outcomeLink->weight,0);?> %, <?php echo $outcomeLink->ato_name;?>
				 <?php if($access){?>
				 	<a href="javascript:editOutcomeAssessment(<?php echo $courseOfferingId;?>,<?php echo $outcomeLink->id;?>);" class="smaller">
                    	<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove outcome assessment link" title="Remove outcome assessment link" >
                    </a>
				 	<?php } ?></td>
		</tr>
			<?php 
		}
		
		if($access)
		{
			$assessmentLinkList = array();
			$dummy = array();
			$dummy['id'] = -1;
			$dummy['value']  = "Please select an assessment";
			array_push($assessmentLinkList,$dummy);
			
			foreach($list_data as $templist)
				{
					
					$infodisplayList =  $templist->short_name .': '.$templist->assessment_name . ($this->common->isValid($templist->additional_info)?" ( ".$templist->additional_info." )":"") .", ".number_format($templist->weight,'1'). "%, " . $templist->ato_name; 
					$dummy['id'] = $templist->id;
					$dummy['value'] = $infodisplayList;
					array_push($assessmentLinkList, $dummy);
				}
			
			$outcomeLinkList = array();
			$dummy = array();
			$dummy['id'] = -1;
			$dummy['value']  = "Please select an outcome to add";
			array_push($outcomeLinkList,$dummy);
			$maxLength = 70;
			foreach($outcomes_data as $templist)
				{
					
					$display = $templist->name;
					if(strlen($display) > $maxLength+5){
						$display = substr($display,0,$maxLength-10). " ... " . substr($display,strlen($display)-10); 		
					}
					$infodisplayList =  substr($display,0,$maxLength - 10) + " ... " + substr($display,strlen($display)-10); 
					$dummy['id'] = $templist->id;
					$dummy['value'] = $display;
					array_push($outcomeLinkList, $dummy);
				}

		?>
		<tr><td><?php  echo $this->common->createSelect("new_course_outcome",$outcomeLinkList,'id','value',null,null);?></td>
			<td><?php  echo $this->common->createSelect("new_assessment_link", $assessmentLinkList,'id','value', '-1',true);?>
			    <input type="button" onclick="editOutcomeAssessment(<?php echo $courseOfferingId;?>,-1);" value="add"/>
			</td>
		</tr>
		<?php } ?>
		
		
		
	</table>
</div>
<hr/>
