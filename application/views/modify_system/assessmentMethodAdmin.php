
<?php

$allGroup = $this->assessment_model->getAssessmentGroups();
$allGroup_data = $allGroup->result();
$allGroup_count = $allGroup->num_rows();
?>
<h2>Available assessment methods:</h2>
<ul>
<?php
$ictrGroup = 0;
foreach($allGroup_data as $rsGroup)
{
?>
	
	<li>
    	<div id="assessment_group_<?php echo $rsGroup->id;?>" >
        <?php
  	      	$data['first'] = ($ictrGroup == 0);
			$data['last'] = ($ictrGroup == $allGroup_count -1);	
			$data['assessment_group_id'] = $rsGroup->id;
			$this->load->view('modify_system/assessmentGroupEdit', $data);
		?>
    	</div>
	</li>
<?php
$ictrGroup++; 
}

?>
	<li>
		<a href="javascript:editGenericSystemField('','AssessmentGroup','name','assessmentMethodAdmin','modify_system/assessmentMethodAdmin');">
	 	Create new assessment group
		</a>
	</li>
</ul>


		
