<h3>Mapping of Program Outcomes to Organization Outcomes</h3>
<br/>
After entering in your program outcomes above using the Manage Program Outcomes link, 
indicate which of your program outcomes link to the organizational outcomes of your College or University. 
To indicate a link between an organization outcome and a program outcome, click "Add/delete link".
<br/>
<?php

if(isset($program_id)){
	$programId = $program_id;
}else{
	$programId = intval($this->input->get("program_id"));
}
//ProgramManager pm = ProgramManager.instance();
$program = $this->program_model->getProgramById($programId);
$program_data = $program->row();
//OrganizationManager om = OrganizationManager.instance();

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;
$orgId = 0;
if($programId > -1)
{
	$organization = $this->program_model->getOrganizationByProgramId($programId);	
	$organization_data = $organization->row();
	$orgId = $organization_data->organization_id;
	
}


$organization = $this->organization_model->getOrganizationById($program_data->organization_id);
$organization_data = $organization->row();
if(!is_null($organization_data->parent_organization_id))
{
	//organization = organization.getParentOrganization();
	$orgId = $organization_data->parent_organization_id; 
}


//List<OrganizationOutcomeGroup> groups = OrganizationManager.instance().getOrganizationOutcomeGroupsOrganization(organization);
$groups = $this->organization_model->getOrganizationOutcomeGroupsOrganization($orgId);
$groups_data = $groups->result();
$groups_count = $groups->num_rows();

if($groups_count < 1)
{
	echo "No Organization Outcomes found";
	//exit();
}else{
?>
<table>
	<tr>
		<th>Category</th>
		<th>Organization Outcome</th>
		<th>Program Outcome</th>
	</tr>
	
<?php
	$prevGroup = "";
	
	foreach($groups_data as $group)
	{
		//List<LinkOrganizationOrganizationOutcome> organizationOutcomes = om.getOrganizationOutcomeForGroupAndOrganization(organization,group);
		$organizationOutcomes = $this->organization_model->getOrganizationOutcomeForGroupAndOrganization($orgId ,$group->organization_outcome_group_id);
		$organizationOutcomes_count = $organizationOutcomes->num_rows();
		$organizationOutcomes_data = $organizationOutcomes->result();
		$first = true;
?>
	<tr>
			<td rowspan="<?php echo $organizationOutcomes_count;?>"><?php echo $group->name;?></td>
		<?php
		foreach($organizationOutcomes_data as $organizationOutcomeLink)
		{
			//OrganizationOutcome organizationOutcome = organizationOutcomeLink.getOrganizationOutcome();
			if(!$first)
				echo "<tr>";
			else
				$first = false;
			?>
			<td>
            	<span title="<?php if($this->common->isValid($organizationOutcomeLink->description)){ echo $organizationOutcomeLink->description; } else { echo "No description"; } ?>">
                	<?php echo $organizationOutcomeLink->name;?>
                </span>
			<a href="javascript:loadModify('modify_program/editOutcomeMapping?program_id=<?php echo $programId;?>&organization_outcome_id=<?php echo $organizationOutcomeLink->id;?>')" class="smaller">Add/delete link</a>
			</td>
			<?php
			$links = $this->organization_model->getProgramOutcomeLinksForOrganizationOutcome($programId, $organizationOutcomeLink->id);
			$links_count = $links->num_rows();
			$links_data = $links->result();
			if(intval($links_count) < 1)
			{
				echo "<td colspan='2'>No Program Outcomes mapped</td>";
			}
			else
			{
				$programOutcomes = "<td><ul>";
				foreach($links_data as $pOutcome)
				{
					//ProgramOutcome pOutcome = link.getProgramOutcome();
					$programOutcomes .= "<li>";
					$programOutcomes .= $pOutcome->po_name;
					$programOutcomes .= "</li>\n";
					
				}
				$programOutcomes .= "</ul></td>\n";
				echo $programOutcomes;
				
			}
			?>
			
			
		</tr>
		<?php
		}?>
	
	<?php }
	

	?>
</table>
<hr/>
<?php }?>