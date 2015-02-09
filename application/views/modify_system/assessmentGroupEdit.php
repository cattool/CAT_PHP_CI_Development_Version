<?php
//CourseManager cm = CourseManager.instance();
//int groupId = HTMLTools.getInt( request.getParameter("assessment_group_id"));
//AssessmentGroup group = cm.getAssessmentGroupById(groupId); 
//boolean first = request.getParameter("first") != null && Boolean.parseBoolean(request.getParameter("first"));
//boolean last = request.getParameter("first") != null && Boolean.parseBoolean(request.getParameter("last"));

$tempassessment_group_id = $this->input->get("assessment_group_id");

if(strlen($tempassessment_group_id) > 0){
	$assessment_group_id = 	$tempassessment_group_id;
}

$group = $this->assessment_model->getAssessmentGroupById($assessment_group_id);
$group_data = $group->row();
?>
	<?php echo $group_data->name; ?>  
			<a href="javascript:editGenericSystemField(<?php echo $group_data->id;?>,'AssessmentGroup','name','assessment_group_<?php echo $group_data->id; ?>','modify_system/assessmentGroupEdit?assessment_group_id=<?php echo $group_data->id; ?>');"> 
            <img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit assessment group" alt="Edit assessment group"/>
           	</a>
	<?php echo  $group_data->short_name; ?>  
			<a href="javascript:editGenericSystemField(<?php echo $group_data->id;?>,'AssessmentGroup','short_name','assessment_group_<?php echo $group_data->id;?>','modify_system/assessmentGroupEdit?assessment_group_id=<?php echo $group_data->id;?>');"> 
            <img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit assessment group (short version)" alt="Edit assessment group (short version)"/>
            </a>
	
	  		<?php 
				if (!isset($first)){
					$first = true;	
				}
				if(!$first){?>
					<a href="javascript:editAssessment(-1,<?php echo $group_data->id;?>,'group_up','#assessment_group_<?php echo $group_data->id;?>');">
                    <img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/>
                   	</a>
            <?php 
				}
				if(!$last){?>
					<a href="javascript:editAssessment(-1,<?php echo $group_data->id;?>,'group_down','#assessment_group_<?php echo $group_data->id;?>');">
                    <img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/></a>
               <?php
				} ?>
	  		
	  		<a href="javascript:editAssessment(<?php echo $group_data->id;?>,<?php echo $group_data->id; ?>,'group_delete','assessment_group_<?php echo $group_data->id; ?>');">
            <img src="<?php echo base_url();?>img/deletes.gif" title="Delete Assessment Group" alt="Delete Assessment Group"/></a>
		<ul>
			<?php
			/*
			List<Assessment> assessments = cm.getAssessmentsForGroup(group);
			for(int i = 0 ; i < assessments.size() ; i++ )
			{
				Assessment a = assessments.get(i);
			*/	
			
			$assessment = $this->assessment_model->getAssessmentsForGroup($group_data->id);
			$assessment_data = $assessment->result();
			$assessment_count = $assessment->num_rows();
			$ictr = 0;
			foreach($assessment_data as $rsAssessment){
			?>
				<li><span title="<?php echo $rsAssessment->description;?>"><?php echo $rsAssessment->name;?></span>
                	<a href="javascript:editGenericSystemField(<?php echo $rsAssessment->id;?>,'Assessment','name','assessment_group_<?php echo $group_data->id;?>','modify_system/assessmentGroupEdit?assessment_group_id=<?php echo $group_data->id;?>');">
                    	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit assessment" alt="Edit assessment"/>
                    </a>
					<a href="javascript:editGenericSystemField(<?php echo $rsAssessment->id;?>,'Assessment','description','assessment_group_<?php echo $group_data->id;?>','modify_system/assessmentGroupEdit?assessment_group_id=<?php echo $group_data->id;?>');">
                    	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit assessment description" alt="Edit assessment description"/>
                    </a>
						
				<?php
				if($ictr>0){?>
					<a href="javascript:editAssessment(<?php echo $rsAssessment->id;?>,<?php echo $group_data->id;?>,'up','#assessment_group_<?php echo $group_data->id;?>');">
                    <img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/></a>
                <?php
				}
				if($ictr < $assessment_count - 1){
				?>
					<a href="javascript:editAssessment(<?php echo $rsAssessment->id;?>,<?php echo $group_data->id;?>,'down','#assessment_group_<?php echo $group_data->id;?>');">
                    <img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/></a>
                <?php
				}
				?>
					<a href="javascript:editAssessment(<?php echo $rsAssessment->id;?>,<?php echo $group_data->id;?>,'delete','#assessment_group_<?php echo $group_data->id;?>');">
                    <img src="<?php echo base_url();?>img/deletes.gif"  alt="Delete assessment" title="Delete assessment"/></a>
				</li>
                <?php
				$ictr++;
			}
			?>
				<li>
					<a href="javascript:editGenericSystemField('','Assessment','name','assessment_group_<?php echo $group_data->id;?>','modify_system/assessmentGroupEdit?assessment_group_id=<?php echo $group_data->id;?>','part_of_id=<?php echo $group_data->id;?>');" class="smaller">
					 	<img src="<?php echo base_url();?>img/add_24.gif"  height="10px;" title="Add assessment to group" alt="Add assessment to group"/> Add assessment to group
					</a>
				</li>
			</ul>
			
		


		
