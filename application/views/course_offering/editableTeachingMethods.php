<?php
$courseOfferingId = $this->input->get("course_offering_id");

if(isset($course_offering_id))
	$courseOfferingId = $course_offering_id;	

//CourseManager cm = CourseManager.instance();
$courseOffering = $this->course_model->getCourseOfferingById(intval($courseOfferingId));
$courseOffering_data = $courseOffering->row();

$optionsList = $this->course_model->getTeachingMethodPortionOptions();
$optionsList_data = $optionsList->result();
$portionIds = array();
$portionValues = array();


//portionIds.add("-1");
array_push($portionIds,-1);
//portionValues.add("Please select a value");
array_push($portionValues,'Please select a value');
		
foreach($optionsList_data as $time)
{
	//portionIds.add(""+time.getId());
	array_push($portionIds,$time->id);
	//portionValues.add(time.getName());
	array_push($portionValues,$time->name);
}

?>
<div id="addTeachingMethodDiv" >
<h2>My Instructional Methods</h2>
<p>This section gathers information about how you teach this course. 
Five types of instructional methods are identified in the first column with example strategies 
for each method in the middle column. Please use the pull down menus in the last column to indicate
 the extent to which you use each instructional method in this course.
   The descriptors are not intended to be numeric.  Where you feel you use overlapping strategies, 
   you can assign those strategies the same "extent of use"" (pull down menu) description. 
    Below a bar graph will display your general distribution of instructional strategies for this course.  
    You also have the option to add information to the comment section appearing below the table.
</p>
	<form name="addTeachingMethodForm" id="teachingMethodForm" method="post" action="" >
		<table >
			<tr>
				<th>Method</th><th>Description</th><th>Extent of Use</th></tr>
				<?php
					$list = $this->course_model->getAllTeachingMethods();
					$list_data = $list->result();
		foreach($list_data as $tm)
		{
			?>
			<tr>
				<td class="padded_cell">
					<?php echo $tm->name;?> 
				</td>
				<td class="padded_cell">
					<?php echo $tm->description;?>
				</td>
				<td>
					<?php
					$existing = $this->course_model->getLinkTeachingMethodByData($courseOfferingId, $tm->id);
					$existing_data = $existing->row();
					$existing_count = $existing->num_rows();
					//print_r($existing_data);
					$selectArray = array();
					$dummy = array();
					$ictr = 0;
					foreach($portionIds as $selId){
						$dummy['id'] = $portionIds[$ictr];	
						$dummy['value'] = $portionValues[$ictr];	
						array_push($selectArray,$dummy);
						$ictr++;	
					}
					//print_r($selectArray);
					//echo $existing_data->id;	
					echo($this->common->createSelect("teachingMethod".$tm->id,$selectArray,'id','value', ($existing_count > 0 ? $existing_data->teaching_method_portion_option_id:''), "editTeachingMethod(".$courseOffering_data->id.",".$tm->id.",this);"));
					
				?>	
				<br/>
				
				<div id="teachingMethodMessage<?php echo $tm->id;?>" style="display:none;" class="error"></div>				
				</td>
				</tr>
		<?php }
		
		?>

		</table>
		<h3>Additional information:</h3>
		<br>
		<p>To add/edit additional information about your instructional methods please click the edit icon below.
		</p>
	<div id="teachingMethodComment">
		
	<?php echo (!$this->common->isValid($courseOffering_data->teaching_comment)?"No additional information entered. Select edit icon below to add additional information about your Instructional Methods.":$courseOffering_data->teaching_comment); ?>
	
</div>
<br/>
<a href="javascript:loadModify('<?php echo site_url();?>course_offering/editComments?course_offering_id=<?php echo $courseOfferingId;?>&type=teachingMethodComment','teachingMethodComment');" class="smaller">
	<img src="<?php echo base_url();?>img/edit_16.gif" alt="Edit instructional methods comment" title="Edit instructional methods comment">
</a>

	</form>
</div>
<div id="teachingMethodsGraphDiv" style="width:600px;height:300px;">
	<img src="<?php echo site_url();?>/course_offering/teachingMethodsBargraph?course_offering_id=<?php echo $courseOffering_data->id;?>"/>
</div>
