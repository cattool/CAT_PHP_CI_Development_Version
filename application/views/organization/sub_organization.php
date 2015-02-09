<?php
// check if sysaddmin
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

//check if user has access

$hasaccess = $this->organization_model->getOrganizationsForUser($this->session->userdata('username'),$id);
$bhasaccess = $hasaccess->num_rows();
$access = false;
if($sysadmin || $bhasaccess > 0){
	$access = true;
}
//get session username
$userid = $this->session->userdata('username');
//get client browser
$uagent = $_SERVER['HTTP_USER_AGENT'];
$clientBrowser = $this->common->os_info($uagent);
			
//echo $id;
$parent = $this->organization_model->getOrganizationById($id);
$parent_data = $parent->row();

$hasParent = false;
if(strlen($parent_data->parent_organization_id)){
	$hasParent = true;	
}
?>

<h<?php if($hasParent) echo "4"; else echo "3"; ?>>
	<a href="javascript:toggleDisplay('org_<?php echo $id; ?>','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
    	<img src="<?php echo base_url();?>/img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="org_<?php echo $id; ?>_img"><?php echo $name; ?>
    </a>
    <?php
	
	 if($sysadmin){ ?> 
    	<a href="javascript:loadModify('<?php echo site_url();?>/modify_system/editOrganization?organization_id=<?php echo $id; ?>&parent_organization_id=<?php if($hasParent){ echo $id;}else{ echo "-1";}?>');">
        	<img src="<?php echo base_url();?>/img/edit_16.gif" alt="Edit organization" title="Edit organization" >
        </a><?php } ?>
<?php if($hasParent) echo "</h4>"; else echo "</h3>"; ?>
<div id="org_<?php echo $id; ?>_div" style="display:none;">
	<div id="Organization_<?php echo $id; ?>_children" style="padding-left:20px;">
    	<div id="Organization_<?php echo $id; ?>_programs">
        	<ul>
				<?php 
                $childProgram = $this->program_model->getProgramByOrgId($id);
				$childProgram_data = $childProgram->result();								

				foreach($childProgram_data as $rschildProgram)
				{				
					if($access)
					{?>
					<li>
                    <a href="<?php echo site_url();?>/program_view/programWrapper?program_id=<?php echo $rschildProgram->id;?>"><?php echo $rschildProgram->name;?></a>												
                    <a href="javascript:removeProgram(<?php echo $rschildProgram->id;?>,<?php echo $id;?>,'<?php echo base_url();?>','<?php echo $clientBrowser;?>');">
                        <img src="<?php echo base_url();?>/img/deletes.gif" style="height:10pt;" alt="Delete program" title="Delete program" >
                    </a>					
					</li>
					<?php 
					}
				 }
				if($access){ ?>
                <li>
					<a href="javascript:loadModify('modify_program/program?organization_id=<?php echo $id;?>');" class="smaller">
                    	<img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add a program" title="Add a program"> 
                        	Add a program
                    </a>
                </li>
				<?php }
				if(!$hasParent && $sysadmin)
					{ ?>
				<li>
                	<a href="javascript:loadModify('modify_system/editOrganization?parent_organization_id=<?php echo $id;?>');" class="smaller">
                        <img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add an organization" title="Add an organization">
                        Add an organization
                    </a>
				<?php }
				if($access)
				{?>
				<li>	
                	<a href="program_admin/organizationOfferingsWrapper?organization_id=<?php echo $id;?>" target="_blank">
                    	Data Completion table (opens in a new tab or window, <b>may take some time to load</b>)
                    </a>
                </li>
				<?php }
				if($access)
				{ ?>
				<li>
                	<a href="modify_program/organizationExport?organization_id=<?php echo $id;?>" target="_blank">
                    	Data Export
                    </a> 
                    The data can be analyzed in excel using tools such as filters, sorts, vlookup and counts, or can be translated and combined for use in other software.
                </li>
				<?php }?>

			</ul>
        </div>
        <?php if($access && !$hasParent){?>
		<a href="javascript:toggleDisplay('settings_org_<?php echo $id; ?>','<?php echo $clientBrowser ?>','<?php echo base_url()?>');" class="smaller">
        	<img src="<?php echo base_url();?>/img/closed_folder_<?php echo $clientBrowser;?>.gif" id="settings_org_<?php echo $id;?>_img">
            	settings
        </a>
		<div id="settings_org_<?php echo $id;?>_div" style="display:none;">
			<div id="Organization_<?php echo $parent_data->id;?>_InstructorAttributes">
            
            <?php	
					
					$attributes = $this->organization_model->getInstructorAttributes($id);
					$attributes_data = $attributes->result();
			?>		
				<h5>Available Instructor Attributes</h5>
				<ul>
				<?php
				
				foreach($attributes_data as $attr)
				{
					?>
						<li><?php echo $attr->name;?>
						<a href="javascript:removeInstructorAttribute(<?php echo $attr->id;?>,<?php echo $id;?>);">
						<img src="<?php echo base_url();?>images/deletes.gif" style="height:10pt;" alt="Delete instructor attribute type" title="Delete instructor attribute type" ></a>
					<?php
				}
				?><li><a href="javascript:loadModify('modify_program/instructorAttribute?organization_id=<?php echo $id;?>');" class="smaller">
                		<img src="<?php echo base_url();?>images/add_24.gif" style="height:10pt;" alt="Add an instructor attribute" title="Add an instructor attribute"> Add an instructor attribute</a></li>
				</ul>
			</div>
			<div id="Organization_<?php echo $parent_data->id;?>_CourseAttributes">
            
			<?php	

					$cattributes = $this->course_model->getCourseAttributes($id);
					$cattributes_data = $cattributes->result();
			?>
					
				<h5>Available Course Attributes</h5>
				<ul>
				<?php
				foreach($cattributes_data as $attr)
				{
					?>
						<li>
						<?php echo $attr->name;?>
						<a href="javascript:removeCourseAttribute(<?php echo $attr->id?>,<?php echo $id;?>);">
                        <img src="<?php echo base_url();?>images/deletes.gif" style="height:10pt;" alt="Delete course attribute" title="Delete course attribute" ></a>
                        </li>
					<?php 
				}
				?>
                <li>
                	<a href="javascript:loadModify('modify_program/courseAttribute?organization_id=<?php echo $id;?>');" class="smaller">
                		<img src="<?php echo base_url();?>images/add_24.gif" style="height:10pt;" alt="Add a course attribute" title="Add a course attribute"> Add a course attribute
                    </a>
                </li>
				</ul>
				<div id="organizationOutcomesDiv_<?php echo $id;?>">
                
                	 <?php 
						$data['organization_id'] = $id;
						$this->load->view('organizationOutcomes',$data);
					?>
				</div>
			
			</div>
		</div>
        <?php }
        
		$childOrg = $this->organization_model->getChildOrganizationsOrderedByName($id, true);
		$childOrgCount = $childOrg->num_rows();
		
		$hasChildren = false;
		if($childOrgCount > 0){
			$hasChildren = true;
		}
	
		if($hasChildren)
		{
		$childOrg_data = $childOrg->result();	
		foreach($childOrg_data as $rsChildOrg)	
		{
			?>
            <div id="<?php echo 'Organization_'.$rsChildOrg->id;?>">
				<?php
                    $this->load->view('organization/sub_organization',$rsChildOrg); 
                ?>
            </div>
		<?php
		}
		}
		?>
    </div>
</div>    