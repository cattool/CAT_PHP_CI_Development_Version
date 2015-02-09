<?php


$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$userid = $this->session->userdata('username');

$access = $sysadmin;


$id  = $this->input->get("organization_id");

if(isset($organization_id)){
	$id = $organization_id;	
}


//OrganizationManager manager = OrganizationManager.instance();

$o = $this->organization_model->getOrganizationById(intval($id));
$o_data = $o->row();

$parent = intval($o_data->parent_organization);

//@SuppressWarnings("unchecked")
//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
//boolean access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(id);



$hasParent = !is_null($o_data->parent_organization);	




//String clientBrowser=request.getHeader("User-Agent");
//simplify the client browser
$uagent = $_SERVER['HTTP_USER_AGENT'];
$clientBrowser = $this->common->os_info($uagent);

$children = $this->organization_model->getChildOrganizationsOrderedByName($o_data->id,true);
$children_data = $children->result();
$children_count = $children->num_rows();
$hasChildren = intval($children_count) > 0;


?>


<?php if($hasParent){ echo "<h4>";} else { echo "<h3>"; } ?>
	<a href="javascript:toggleDisplay('org_<?php echo $id;?>','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
		<img src="<?php echo base_url();?>/img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="org_<?php echo $id;?>_img"><?php echo $o_data->name;?>
    </a>
    	<?php if($sysadmin){?> 
        	<a href="javascript:loadModify('modify_system/editOrganization?organization_id=<?php echo $o_data->id;?>&parent_organization_id=<?php if($hasParent){ echo $o_data->id; } else { echo "-1"; } ?>');">
            	<img src="<?php echo base_url();?>/img/edit_16.gif" alt="Edit organization" title="Edit organization" ></a><?php } ?>
            
			<?php if($hasParent) { echo "</h4>"; } else { echo "</h3>"; }?>
<div id="org_<?php echo $id ?>_div" style="display:none;">
	<div id="Organization_<?php echo $o_data->id;?>_children" style="padding-left:20px;">
		<div id="Organization_<?php echo $o_data->id; ?>_programs">
			<ul>
				<?php 
				$program = $this->program_model->getProgramByOrgId($o_data->id);
				$program_data = $program->result();
				foreach($program_data as $p)
				{?>
					<?php if($access){?>
					<li><a href="program_view/programWrapper?program_id=<?php echo $p->id;?>"><?php echo $p->name;?></a>						
						<a href="javascript:removeProgram(<?php echo $p->id;?>,<?php echo $o_data->id;?>,'<?php echo base_url();?>','<?php echo $clientBrowser;?>');">
                        <img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Delete program" title="Delete program" ></a>					
					</li>
					<?php }?>
				<?php }
				if($access){?><li>
					<a href="javascript:loadModify('modify_program/program?organization_id=<?php echo $o_data->id;?>');" class="smaller">
                    	<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add a program" title="Add a program"> 
                        Add a program
                    </a></li>
				<?php }
				if(!$hasParent && $sysadmin)
					{?>
				<li><a href="javascript:loadModify('modify_system/editOrganization?parent_organization_id=<?php echo $o_data->id;?>');" class="smaller">
                	<img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add an organization" title="Add an organization">Add an organization</a>
				<?php }
				
				if($access)
				{?>
				<li>
                	<a href="program_view/organizationOfferingsWrapper?organization_id=<?php echo $o_data->id;?>" target="_blank">
                	Data Completion table (opens in a new tab or window, <b>may take some time to load</b>)
                    </a>
                </li>
				<?php }
				if($access)
				{?>
				<li>
                	<a href="modify_program/organizationExport?organization_id=<?php echo $o_data->id;?>" target="_blank">
                    	Data Export</a> The data can be analyzed in excel using tools such as filters, sorts, vlookup and counts, or can be translated and combined for use in other software.</li>
				<?php } ?>
			</ul>		
		</div>
		<?php if($access && !$hasParent) 
		{?>
        
		<a href="javascript:toggleDisplay('settings_org_<?php echo $id;?>','<?php echo $clientBrowser;?>','<?php echo base_url()?>');" class="smaller">
        	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser;?>.gif" id="settings_org_<?php echo $id;?>_img">settings</a>
		<div id="settings_org_<?php echo $id;?>_div" style="display:none;">
			<div id="Organization_<?php echo $o_data->id;?>_InstructorAttributes">
			<?php
			 
				$attributes = $this->organization_model->getInstructorAttributes($o_data->id);
				$attributes_data = $attributes->result();
			?>
			
				<h5>Available Instructor Attributes</h5>
				<ul>
				<?php
				foreach($attributes_data as $attr)
				{
					?>
						<li><?php echo $attr->name;?>
						<a href="javascript:removeInstructorAttribute(<?php echo $attr->id;?>,<?php echo $o_data->id;?>);">
                        	<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Delete instructor attribute type" title="Delete instructor attribute type" ></a>
					<?php
				}
				?><li><a href="javascript:loadModify('modify_program/instructorAttribute?organization_id=<?php echo $o_data->id;?>');" class="smaller">
                	<img src="<?php echo base_url()?>img/add_24.gif" style="height:10pt;" alt="Add an instructor attribute" title="Add an instructor attribute"> Add an instructor attribute</a></li>
				</ul>
			</div>
			<?php 
				
			$cattributes = $this->course_model->getCourseAttributes($o_data->id);
			$cattributes_data = $cattributes->result();
			?>
			
				<h5>Available Course Attributes</h5>
				<ul>
				<?php
				foreach($cattributes_data as $attr)
				{
					?>
						<li><?php echo $attr->name;?>
						<a href="javascript:removeCourseAttribute(<?php echo $attr->id;?>,<?php echo $o_data->id;?>);">
                        	<img src="<?php echo base_url();?>/img/deletes.gif" style="height:10pt;" alt="Delete course attribute" title="Delete course attribute" ></a>
					<?php 
				}
				?><li><a href="javascript:loadModify('modify_program/courseAttribute?organization_id=<?php echo $o_data->id;?>');" class="smaller">
                	<img src="<?php echo base_url()?>/img/add_24.gif" style="height:10pt;" alt="Add a course attribute" title="Add a course attribute"> 
                    	Add a course attribute</a></li>
				</ul>
				<div id="organizationOutcomesDiv_<?php echo $o_data->id;?>">
					<!---<jsp:include page="organizationOutcomes.jsp">
						<jsp:param name="organization_id" value="<%=o.getId()%>"/>
					</jsp:include>--->
                    <?php
						$data['organization_id'] = $o_data->id;
						$this->load->view('organizationOutcomes',$data);
					?>
				</div>
			</div>
		</div>
	<?php
		}
	if(intval($children_count) > 0)
	{
		foreach($children_data as $child)
		{
			
			?>
			<div id="Organization_<?php echo $child->id;?>">
				<!---<jsp:include page="organization.jsp">
					<jsp:param name="organization_id" value="<%=child.getId()%>" />
				</jsp:include>--->
                 <?php
					$data['organization_id'] = $child->id;
					$this->load->view('organization',$data);
				?>
			</div>
			<?php
		}?>
		
	<?php }
	?>
	
	</div>	
</div>			


