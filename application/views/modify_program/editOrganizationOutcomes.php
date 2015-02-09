<?php
$organizationId = intval($this->input->get("organization_id"));

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

$access = $sysadmin;

if(!$sysadmin)
{
	echo("permission denied. You need to be a system administrator to edit available organization outcomes");
	return;
}

//OrganizationManager om = OrganizationManager.instance();

$organization = $this->organization_model->getOrganizationById($organizationId);
$organization_data = $organization->result();
?>
<h4>Edit Available Organization Outcomes (First for <?php echo $organization_data->name;?> followed by the General Organization Outcomes)</h4>
<ul>
<?php
$groups = $this->organization_model->getOrganizationOutcomeGroupsForOrg($organizationId);
$groups_data = $groups->result();



foreach($groups_data as $group)
{
	?>
	<li><strong><?php echo $group->name;?></strong>	 
		<a href="javascript:editGenericProgramField(<?php echo $group->id;?>,'OrganizationOutcomeGroup','name','editDiv','modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>');" class="smaller">
        	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit outcome category" alt="Edit outcome category"/>
        </a>
		<a href="javascript:editOutcome('OrganizationOutcomeGroup',<?php echo $group->id;?>,<?php echo $organizationId?>,'delete');">
        	<img src="<?php echo base_url();?>img/deletes.gif" alt="Delete outcoem category" title="Delete outcome category"/></a>
	</li>
	<li>
		<ul style="padding-left:15px;line-height:1.0em;">
		<?php
	
		$outcomes = $this->organization_model->getOrganizationOutcomeForGroup($group->id);
		$outcomes_data = $outcomes->result();
		
		foreach($outcomes_data as $outcome)
		{
			?>
			<li><?php echo $outcome->oo_name;?>
			 <a href="javascript:editGenericProgramField(<?php echo $outcome->oo_id;?>,'OrganizationOutcome','name','editDiv','modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>');" class="smaller">
             	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit outcome" alt="Edit outcome"/></a>
			 <a href="javascript:editGenericProgramField(<?php echo $outcome->oo_id;?>,'OrganizationOutcome','description','editDiv','modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>');" class="smaller">
             	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit outcome description" alt="Edit outcome description"/></a>
			 <a href="javascript:editOutcome('OrganizationOutcome',<?php echo $outcome->oo_id;?>,<?php echo $organizationId;?>,'delete');">
             	<img src="<?php echo base_url();?>img/deletes.gif" alt="Delete outcome" title="Delete outcome"/></a>
			</li>
			
					
			<?php
		}
		?>
			<li>
				<a href="javascript:editGenericProgramField(-1,'OrganizationOutcome','name','editDiv','modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>','organization_outcome_group_id=<?php echo $group->id;?>');" class="smaller">
                <img src="<?php echo base_url();?>img/edit_16.gif" alt="Add outcome to outcome category" title="Add outcome to outcome category"/>
                	Add Outcome to outcome category
                </a>
			</li>
		</ul>
	</li>
	<?php
}
?>
	<li>
		<a href="javascript:editGenericProgramField(-1,'OrganizationOutcomeGroup','name','editDiv','modify_program/editOrganizationOutcomes?organization_id=<?php echo $organizationId;?>','organization_id=<?php echo $organizationId?>');" class="smaller">Create new outcome category for <?php echo $organization_data->name;?></a>
	</li>
	<li>
		<a href="javascript:editGenericProgramField(-1,'OrganizationOutcomeGroup','name','editDiv','modify_program/editOrganizationOutcomes.jsp?organization_id=<?php echo $organizationId;?>','organization_id=-1');" class="smaller">Create new "General" outcome category</a>
	</li>
	
</ul>

