<?php

$organizationId = $this->input->get("organization_id") ;
$courseOfferingId = $this->input->get("course_offering_id") ;



//HashMap<String,CourseOffering> userHasAccessToOfferings = (HashMap<String,CourseOffering>)session.getAttribute("userHasAccessToOfferings");
$userHasAccessToOfferings = $this->session->userdata('userHasAccessToOfferings');
/*
Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
boolean sysadmin = sessionValue != null && sessionValue;
boolean access = sysadmin || (userHasAccessToOfferings!=null && userHasAccessToOfferings.containsKey(courseOfferingId));
*/

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
//CourseOffering courseOffering = null;
if($this->common->isValid($courseOfferingId))
{
	$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
	$courseOffering_data = $courseOffering->row();
}

$list = $this->course_model->getAssessmentsForCourseOffering($courseOfferingId);
$list_data = $list->result();
$list_count = $list->num_rows();
$timeOptionsList = $this->course_model->getAssessmentTimeOptions();
$timeOptionsList_data = $timeOptionsList->result();

$timeOptions = array();

foreach($timeOptionsList_data as $time)
{	
	//timeOptions.add(time.getName());
	array_push($timeOptions,$time->name);
}
$assessmentSum = 0.0;
//NumberFormat formatter = NumberFormat.getInstance();
//formatter.setMaximumFractionDigits(1);
?>
<h2>My Assessment Methods</h2>
<p>
This section gathers information about how and when students in your course are assessed. 
To complete this table, select the <i><b>add method</b></i> button and submit the information requested. 
Repeat this process until you have added all the assessment methods used in your course, totaling 100% of the grade. 
Two bar graphs will appear below showing the distribution of assessments across time and the types of assessment methods used.
</p>
<div>
	<table cellpadding="0" cellspacing="0" border="1">
		<tr><th>Method-name</th><th> % of total mark</th><th>Due</th></tr>
		<?php

		foreach($list_data as $link)
		{
			$additionalInfo = $link->additional_info;
			//$group = link.getAssessment().getGroup();
			$additionalInfoDisplay = "";
			if($link->assessment_group_id != null)
				$additionalInfoDisplay = $link->short_name. ": ";
			
			$additionalInfoDisplay .= $link->assessment_name . ($this->common->isValid($additionalInfo)?" ( ".$additionalInfo." )":"");
			
			$assessmentSum += $link->weight;
			?>
		<tr>
			<td><?php echo $additionalInfoDisplay;?> <a href="javascript:showMoreAssessmentInfo(<?php echo $link->id;?>,<?php echo $courseOfferingId?>);" class="smaller">More info</a>
			<?php if(strtoupper($link->criterion_exists) == "Y")
				{?><span style="font-weight:bold;"> criterion threshold: <?php echo $link->criterion_level;?></span>
				<?php } ?> 
				 <?php if($access){?>
				 	<a href="javascript:loadModify('<?php echo site_url();?>course_offering/editAssessmentMethods?assessment_link_id=<?php echo $link->id;?>&course_offering_id=<?php echo $courseOfferingId;?>');" class="smaller">
                    	<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit assessment method" title="Edit assessment method"></a>
				 	<a href="javascript:removeAssessmentMethod(<?php echo $link->id;?>,<?php echo $courseOfferingId;?>);" class="smaller">
                    	<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove assessment method" title="Remove assessment method" ></a>
				 	<?php } ?><div id="additionalAssessmentInfo_<?php echo $link->id;?>" style="display:none;padding:10px;"></div></td>
			<td><?php echo number_format($link->weight,0, '.', ',');?> %</td>
			<td><?php echo $link->ato_name;?></td>
		</tr>
			<?php 
		}
		
		
		
		if($list_count < 1)
		{
			?>
			<tr><td colspan="3">No Assessment methods added (yet)</td></tr>
			<?php 
		}
		else
		{
			$sumStyle ="";
			$sumNote = "&nbsp;";
			if(abs($assessmentSum - 100) > 0.05)
			{
				?>
				<tr style="color:red;font-weight:bold;">
					<td style="text-align:right;">Total : </td>
					<td>  <?php echo number_format($assessmentSum,'1');?> </td>
					<td> The total does not add up to 100%</td>
				</tr>	
				<?php
			}
			else
			{
				?>
				<tr>
					<td style="text-align:right;">Total : </td>
					<td> 100% </td>
					<td>&nbsp;</td>
				</tr>
				<?php
			}
		}
		if($access)
		{
		?>
		<tr><td colspan="4"><a href="javascript:loadModifyIntoDiv('course_offering/editAssessmentMethods?course_offering_id=<?php echo $courseOfferingId;?>','addAssessmentMethodDiv');" class="smaller">
        	<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add assessment method" title="Add assessment method">Add assessment method</a>
			<hr/>
			<div id="addAssessmentMethod">
				
			</div>
		</td></tr>
		<?php } ?>
		
		
		
	</table>
</div>
<div>
	Assessment options entered as "ongoing" will be evenly distributed between the entries marked with an *.
</div>
<hr/>
<?php $time = round(microtime(true) * 1000);//System.currentTimeMillis(); ?>
<?php /*
<div id="assessmentMethodsBargraphDiv" style="width:550px;height:300px;">
	<img src="<?php echo site_url();?>course_offering/assessmentMethodBargraph?course_offering_id=<?php echo $courseOffering_data->id;?>&bogus_param=<?php echo $time;?>"/>
</div>
<div id="assessmentMethodGroupsDiv" style="width:550px;height:300px;">
	<img src="<?php echo site_url()?>course_offering/assessmentMethodGroups?course_offering_id=<?php echo $courseOffering_data->id();?>&bogus_param=<?php echo $time;?>"/>	
</div>
*/ ?>
